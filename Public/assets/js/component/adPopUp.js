// =========================================================
// 1. CONFIGURATION & STATE
// =========================================================
let bookedDB = {};
let MAX_CAPACITY = 5;

const availableHours = [
  "00:00",
  "01:00",
  "02:00",
  "03:00",
  "04:00",
  "05:00",
  "06:00",
  "07:00",
  "08:00",
  "09:00",
  "10:00",
  "11:00",
  "12:00",
  "13:00",
  "14:00",
  "15:00",
  "16:00",
  "17:00",
  "18:00",
  "19:00",
  "20:00",
  "21:00",
  "22:00",
  "23:00",
];

// State Management
let currentDate = new Date();
// Optional: Force a specific start month for demo (remove if not needed)
// currentDate.setFullYear(2026, 0, 1);

let selectionStep = 1; // 1 = Picking Start, 2 = Picking End
let startSelection = { date: null, time: null };
let endSelection = { date: null, time: null };
let viewingDate = null; // Which date's time slots are we viewing?

// =========================================================
// 2. INITIALIZATION & EVENT LISTENERS
// =========================================================
document.addEventListener("DOMContentLoaded", function () {
  console.log("Ad Manager Initialized");

  // --- Modal Controls ---
  const modal = document.getElementById("advModal");
  const openBtn = document.getElementById("openModalBtn");
  const closeBtn = document.getElementById("closeModalBtn");
  const resetBtn = document.getElementById("resetBtn");

  if (openBtn) {
    openBtn.addEventListener("click", () => {
      modal.style.display = "flex";
      // Initial Load
      resetSelection();
      fetchBookedSlots();
    });
  }

  if (closeBtn)
    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });
  if (resetBtn) resetBtn.addEventListener("click", resetSelection);

  window.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
  });

  // --- Calendar Navigation ---
  document.getElementById("prevMonth").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
  });
  document.getElementById("nextMonth").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
  });

  // --- Placement & Community Logic ---
  const placementRadios = document.querySelectorAll('input[name="placement"]');
  const communitySelect = document.getElementById("community_id_input");

  // 1. Handle Radio Change (Home Page vs Community)
  placementRadios.forEach((radio) => {
    radio.addEventListener("change", () => {
      handlePlacementChange();
      toggleFileUpload();
      resetSelection(); // Context changed, so reset data
      fetchBookedSlots(); // Load new data
    });
  });
  handlePlacementChange();
  // 2. Handle Community Dropdown Change
  if (communitySelect) {
    communitySelect.addEventListener("change", () => {
      resetSelection();
      fetchBookedSlots(); // Reload data for the specific community
    });
  }

  // Initial Setup
  toggleCommunitySelect();
  toggleFileUpload();
});

// =========================================================
// 3. DATA FETCHING (THE "BRAIN")
// =========================================================
async function fetchBookedSlots() {
  try {
    // 1. Get Settings
    const placementRadio = document.querySelector(
      'input[name="placement"]:checked'
    );
    const placement = placementRadio ? placementRadio.value : "homepage_poster";
    const communityInput = document.getElementById("community_id_input");
    const communityId = communityInput ? communityInput.value : "";

    // 2. Determine Capacity Rules
    if (placement === "community_poster") {
      MAX_CAPACITY = 1; // Strict limit for local chats

      // If no community selected yet, don't fetch anything
      if (!communityId) {
        bookedDB = {};
        renderCalendar();
        document.getElementById("timeSlotsContainer").innerHTML =
          '<p class="placeholder-text" style="color:#d9534f;">Please select a community above to see availability.</p>';
        return;
      }
    } else {
      MAX_CAPACITY = 5; // Global limit for Home Page/Class Ads
    }

    // 3. Prepare UI for loading
    document.getElementById("calendarGrid").innerHTML =
      '<div style="padding:30px; text-align:center; color:#666;">Checking availability...</div>';

    // 4. Construct URL
    let url = `${ROOT}/ClassManager/getBookedSlots?placement=${placement}`;
    if (placement === "community_poster" && communityId) {
      url += `&community_id=${communityId}`;
    }

    // 5. Fetch Data
    const response = await fetch(url);
    if (!response.ok) throw new Error("Network response error");

    bookedDB = await response.json();
    console.log(
      `Data Loaded | Mode: ${placement} | Cap: ${MAX_CAPACITY}`,
      bookedDB
    );

    // 6. Render
    renderCalendar();
    if (viewingDate) generateTimeSlots(viewingDate);
  } catch (error) {
    console.error("Failed to fetch slots:", error);
    document.getElementById("calendarGrid").innerHTML =
      '<div style="padding:20px; color:red;">Error loading data.</div>';
  }
}

// =========================================================
// 4. CALENDAR RENDERING
// =========================================================
function renderCalendar() {
  const calendarGrid = document.getElementById("calendarGrid");
  document.getElementById("currentMonthYear").innerText =
    currentDate.toLocaleString("default", { month: "long", year: "numeric" });

  calendarGrid.innerHTML = "";

  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Block dates older than today (or handle 10-day logic if you prefer)
  const today = new Date();
  today.setHours(0, 0, 0, 0);

  for (let i = 1; i <= daysInMonth; i++) {
    const dayDiv = document.createElement("div");
    dayDiv.classList.add("calendar-day");
    dayDiv.innerText = i;

    const dateKey = `${year}-${String(month + 1).padStart(2, "0")}-${String(
      i
    ).padStart(2, "0")}`;
    const cellDate = new Date(year, month, i);

    // A. Disable Past Dates
    if (cellDate < today) {
      dayDiv.classList.add("disabled");
    }
    // B. Check Full Bookings (Optional visual helper)
    // If every single hour in this day is at capacity, mark it full.
    else {
      let isDayFull = true;

      // Loop through ALL available hours to see if they are all taken
      for (const time of availableHours) {
        // Get count for this specific hour (default to 0 if empty)
        let count = 0;
        if (bookedDB[dateKey] && bookedDB[dateKey][time]) {
          count = bookedDB[dateKey][time];
        }

        // If we find ONE slot that is not full, the day is available
        if (count < MAX_CAPACITY) {
          isDayFull = false;
          break; // Stop checking, we found a free spot
        }
      }
      // Simple check: do we have data for this day?
      // Note: For accurate "Full Day" check, we'd need to loop all hours.
      // For now, we rely on the Time Slot view for details.
      if (isDayFull) {
        dayDiv.classList.add("full-booked"); // Add Red Color
        dayDiv.classList.add("disabled"); // Make unclickable
        dayDiv.title = "No slots available on this day";
      }
    }

    // C. Highlight User Selections
    if (startSelection.date === dateKey) dayDiv.classList.add("selected-start");
    if (endSelection.date === dateKey) dayDiv.classList.add("selected-end");

    // D. Highlight Range
    if (startSelection.date && endSelection.date) {
      if (dateKey > startSelection.date && dateKey < endSelection.date) {
        dayDiv.classList.add("in-range");
      }
    }

    // E. Add Click Handler
    if (!dayDiv.classList.contains("disabled")) {
      dayDiv.addEventListener("click", () => handleDateClick(dateKey));
    }

    calendarGrid.appendChild(dayDiv);
  }
}

function handleDateClick(dateKey) {
  // Step 1: Pick Start Date
  if (selectionStep === 1) {
    startSelection.date = dateKey;
    startSelection.time = null;
    viewingDate = dateKey;
    updateUI();
    generateTimeSlots(dateKey);
  }
  // Step 2: Pick End Date
  else if (selectionStep === 2) {
    // Basic Validation: End cannot be before Start
    if (dateKey < startSelection.date) {
      alert("End date cannot be before Start date!");
      return;
    }

    endSelection.date = dateKey;
    endSelection.time = null; // Reset time until they pick one
    viewingDate = dateKey;
    updateUI();
    generateTimeSlots(dateKey);
  }
  renderCalendar();
}

// =========================================================
// 5. TIME SLOT LOGIC & VALIDATION
// =========================================================
function generateTimeSlots(dateKey) {
  const container = document.getElementById("timeSlotsContainer");
  container.innerHTML = "";

  const isStartDate = dateKey === startSelection.date;

  availableHours.forEach((time) => {
    const btn = document.createElement("div");
    btn.classList.add("time-btn");
    btn.innerText = time;

    // 1. Filter: If picking End Time on Same Day, hide times before Start Time
    if (selectionStep === 2 && isStartDate) {
      if (time <= startSelection.time) return; // Skip
    }

    // 2. Check Capacity (The core change!)
    // bookedDB[dateKey][time] gives us the CURRENT COUNT (e.g., 3)
    let currentCount = 0;
    if (bookedDB[dateKey] && bookedDB[dateKey][time]) {
      currentCount = bookedDB[dateKey][time];
    }

    // 3. Visual State
    if (currentCount >= MAX_CAPACITY) {
      btn.classList.add("booked"); // FULL
      btn.title = "Fully Booked";
    } else {
      btn.classList.add("available");

      // Show remaining slots if it's getting tight (Optional)
      // if (currentCount > 0) btn.style.border = "1px solid orange";

      // Highlight Active Selection
      if (
        (selectionStep === 1 && startSelection.time === time) ||
        (selectionStep === 2 && endSelection.time === time)
      ) {
        btn.classList.add("selected");
      }

      btn.addEventListener("click", () => handleTimeClick(time));
    }

    container.appendChild(btn);
  });
}

function handleTimeClick(time) {
  // --- SELECTING START ---
  if (selectionStep === 1) {
    startSelection.time = time;
    // Auto-advance to Step 2
    selectionStep = 2;
    // Default Step 2 to same date
    endSelection.date = startSelection.date;
    viewingDate = endSelection.date;

    updateUI();
    generateTimeSlots(viewingDate);
  }
  // --- SELECTING END ---
  else if (selectionStep === 2) {
    // IMPORTANT: VALIDATE THE WHOLE RANGE BEFORE ACCEPTING
    const isValid = !isRangeBlocked(
      startSelection.date,
      startSelection.time,
      viewingDate, // Current viewing date is the end date
      time
    );

    if (isValid) {
      endSelection.time = time;
      updateUI();
      generateTimeSlots(viewingDate); // Refresh to show highlight
      checkFormValidity();
    }
  }
}

/**
 * LOOPS through every single hour in the requested range
 * and checks if Count >= MAX_CAPACITY.
 */
function isRangeBlocked(startDateStr, startTimeStr, endDateStr, endTimeStr) {
  let current = new Date(`${startDateStr}T${startTimeStr}`);
  let end = new Date(`${endDateStr}T${endTimeStr}`);

  // Loop hour by hour
  while (current < end) {
    const year = current.getFullYear();
    const month = String(current.getMonth() + 1).padStart(2, "0");
    const day = String(current.getDate()).padStart(2, "0");
    const dateKey = `${year}-${month}-${day}`;
    const hour = String(current.getHours()).padStart(2, "0") + ":00";

    // Check DB Count
    let count = 0;
    if (bookedDB[dateKey] && bookedDB[dateKey][hour]) {
      count = bookedDB[dateKey][hour];
    }

    // If this specific hour is FULL
    if (count >= MAX_CAPACITY) {
      alert(
        `The slot on ${dateKey} at ${hour} is fully booked! (Capacity: ${count}/${MAX_CAPACITY})`
      );
      return true; // Blocked
    }

    // Next Hour
    current.setHours(current.getHours() + 1);
  }

  return false; // Range is clean
}

// =========================================================
// 6. UI HELPERS & FORMS
// =========================================================
function updateUI() {
  const startDisplay = document
    .getElementById("startDisplay")
    .querySelector(".value");
  const endDisplay = document
    .getElementById("endDisplay")
    .querySelector(".value");
  const header = document.getElementById("timeSlotHeader");
  const feedback = document.getElementById("selectionFeedback");

  startDisplay.innerText = startSelection.date
    ? `${startSelection.date} @ ${startSelection.time || "..."}`
    : "Select Date...";
  startDisplay.style.color = selectionStep === 1 ? "#27ae60" : "#333";

  endDisplay.innerText = endSelection.date
    ? `${endSelection.date} @ ${endSelection.time || "..."}`
    : "...";
  endDisplay.style.color = selectionStep === 2 ? "#c0392b" : "#333";

  if (selectionStep === 1) {
    header.innerText = "1. Select Start Time";
    feedback.innerText = "Please pick a start time.";
  } else {
    header.innerText = `2. Select End Time (${viewingDate})`;
    feedback.innerText = "Please pick an end time.";
  }

  // Update Hidden Form Inputs
  document.getElementById("input_start_date").value = startSelection.date || "";
  document.getElementById("input_start_time").value = startSelection.time || "";
  document.getElementById("input_end_date").value = endSelection.date || "";
  document.getElementById("input_end_time").value = endSelection.time || "";
}

function resetSelection() {
  selectionStep = 1;
  startSelection = { date: null, time: null };
  endSelection = { date: null, time: null };
  viewingDate = null;

  document.getElementById("timeSlotsContainer").innerHTML =
    '<p class="placeholder-text">Please select a date first.</p>';
  renderCalendar();
  updateUI();
  checkFormValidity();
}

function checkFormValidity() {
  const submitBtn = document.getElementById("submitAdvBtn");
  const isValid =
    startSelection.date &&
    startSelection.time &&
    endSelection.date &&
    endSelection.time;

  if (isValid) {
    submitBtn.disabled = false;
    submitBtn.style.backgroundColor = "#1E2A5E";
    submitBtn.style.cursor = "pointer";
  } else {
    submitBtn.disabled = true;
    submitBtn.style.backgroundColor = "#ccc";
  }
}

// --- Toggle Logic ---
function toggleFileUpload() {
  const radios = document.getElementsByName("placement");
  const uploadContainer = document.getElementById("fileUploadContainer");
  const fileInput = document.getElementById("ad_file");
  let selectedValue = "";

  for (const radio of radios) {
    if (radio.checked) {
      selectedValue = radio.value;
      break;
    }
  }

  // Hide upload for Class Ads
  if (selectedValue === "homepage_class_section") {
    uploadContainer.style.display = "none";
    fileInput.required = false;
    fileInput.value = "";
    document.getElementById("fileNameDisplay").textContent = "";
  } else {
    uploadContainer.style.display = "block";
    fileInput.required = true;
  }
}

function handlePlacementChange() {
  // 1. Get the selected radio button value
  const placement = document.querySelector(
    'input[name="placement"]:checked'
  ).value;

  // 2. Get all the containers
  const communityDiv = document.getElementById("community_select");
  const communityInput = document.getElementById("community_id_input");

  const classDiv = document.getElementById("class_select_container");
  const classInput = document.getElementById("class_id_input");

  // --- NEW: Get the Description Elements ---
  const descDiv = document.getElementById("community_desc_container");
  const descInput = document.getElementById("ad_description");

  const uploadContainer = document.getElementById("fileUploadContainer");
  const fileInput = document.getElementById("ad_file");

  // 3. RESET EVERYTHING (Hide all first)
  communityDiv.classList.add("hidden");
  communityInput.required = false;

  classDiv.classList.add("hidden");
  classInput.required = false;

  // Hide Description
  descDiv.classList.add("hidden");
  descInput.required = false;

  // Show Upload by default
  uploadContainer.style.display = "block";
  fileInput.required = true;

  // 4. SHOW BASED ON SELECTION
  if (placement === "community_poster") {
    // Show Community Dropdown
    communityDiv.classList.remove("hidden");
    communityInput.required = true;

    // --- SHOW DESCRIPTION ---
    descDiv.classList.remove("hidden");
    descInput.required = true; // Make it required!
  } else if (placement === "homepage_class_section") {
    // Show Class Dropdown
    classDiv.classList.remove("hidden");
    classInput.required = true;

    // Hide File Upload (we use class thumbnail instead)
    uploadContainer.style.display = "none";
    fileInput.required = false;
  }
  // "homepage_poster" falls through to the defaults (everything hidden except upload)
}
