// --- Global DOM elements ---
const calendarGrid = document.getElementById("calendar-grid");
const currentMonthYear = document.getElementById("current-month-year");
const eventModal = document.getElementById("event-modal");
const closeBtn = eventModal.querySelector(".close-btn");
const cancelBtn = document.getElementById("cancel-btn");

const eventDateInput = document.getElementById("event-date");
const eventTitleInput = document.getElementById("event-title");
const eventDescriptionInput = document.getElementById("event-description");
const eventTimeInput = document.getElementById("event-time");

// Tooltip
const tooltip = document.getElementById("event-tooltip");

// Current month/year tracking
let currentDate = new Date();

// --- Modal functions ---
function openModal(dateStr, event = null) {
  const eventModal = document.getElementById("event-modal");
  const eventIdInput = document.getElementById("event-id");
  const eventTitleInput = document.getElementById("event-title");
  const eventDescriptionInput = document.getElementById("event-description");
  const eventTimeInput = document.getElementById("event-time");
  const eventDateInput = document.getElementById("event-date");
  const saveBtn = eventModal.querySelector('button[type="submit"]');
  const cancelBtn = document.getElementById("cancel-btn");

  // Reset all fields
  eventTitleInput.value = "";
  eventDescriptionInput.value = "";
  eventTimeInput.value = "";
  eventDateInput.value = dateStr;
  if (eventIdInput) eventIdInput.value = "";

  if (event) {
    eventTitleInput.value = event.event_title || "";
    eventDescriptionInput.value = event.event_description || "";
    eventTimeInput.value = event.event_time || "";
    if (eventIdInput) eventIdInput.value = event.id || "";

    eventModal.querySelector("h3").textContent = "Edit Event";

    // Change buttons
    saveBtn.textContent = "Update";
    saveBtn.onclick = (e) => {
      e.preventDefault();
      updateEvent(event.id);
    };

    cancelBtn.textContent = "Delete";
    cancelBtn.onclick = () => deleteEvent(event.id);
  } else {
    eventModal.querySelector("h3").textContent = "Add Event";
    saveBtn.textContent = "Save";
    saveBtn.onclick = null;
    cancelBtn.textContent = "Cancel";
    cancelBtn.onclick = closeModal;
  }

  eventModal.style.display = "block";
}

function deleteEvent(eventId) {
  fetch(`${appRoot}/StudentProfile/delete_event`, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `event_id=${eventId}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data.includes("success")) {
        alert("Event deleted successfully.");
        closeModal();

        studentEvents = studentEvents.filter((event) => {
          return event.id != eventId;
        });

        renderCalendar();
      } else {
        console.error("Delete response:", data);
        alert("Something went wrong while deleting the event.");
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Something went wrong while deleting the event.");
    });
}
function updateEvent(eventId) {
  const eventForm = document.getElementById("event-form");
  const formData = new FormData(eventForm);

  fetch(`${appRoot}/StudentProfile/update_event`, {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((response) => {
      // Use .includes() for safety
      if (response.includes("success")) {
        alert("Event updated successfully");
        closeModal();

        // --- Update calendar without reload ---
        const index = studentEvents.findIndex((e) => e.id == eventId);

        if (index > -1) {
          studentEvents[index].event_title = formData.get("event_title");
          studentEvents[index].event_date = formData.get("event_date");
          studentEvents[index].event_time = formData.get("event_time");
          studentEvents[index].event_description =
            formData.get("event_description");
        }

        renderCalendar();
      } else {
        console.error("Update failed. Server response:", response);
        alert(
          "Something went wrong. Check the console (F12) for the server error."
        );
      }
    })
    .catch((err) => {
      console.error(err);
      alert("Error updating event");
    });
}

function closeModal() {
  eventModal.style.display = "none";
}

closeBtn.addEventListener("click", closeModal);
cancelBtn.addEventListener("click", closeModal);
window.addEventListener("click", (e) => {
  if (e.target === eventModal) closeModal();
});

// --- Calendar rendering ---
function renderCalendar() {
  calendarGrid.innerHTML = "";

  const month = currentDate.getMonth();
  const year = currentDate.getFullYear();

  currentMonthYear.textContent = new Intl.DateTimeFormat("en-US", {
    year: "numeric",
    month: "long",
  }).format(currentDate);

  // Weekday headers
  ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"].forEach((day) => {
    const weekdayCell = document.createElement("div");
    weekdayCell.classList.add("calendar-weekday");
    weekdayCell.textContent = day;
    calendarGrid.appendChild(weekdayCell);
  });

  const firstDayOfMonth = new Date(year, month, 1);
  const startDayOfWeek = firstDayOfMonth.getDay();

  // Empty cells before first day
  for (let i = 0; i < startDayOfWeek; i++) {
    const emptyCell = document.createElement("div");
    emptyCell.classList.add("calendar-day", "empty");
    calendarGrid.appendChild(emptyCell);
  }

  const daysInMonth = new Date(year, month + 1, 0).getDate();

  for (let day = 1; day <= daysInMonth; day++) {
    const dayCell = document.createElement("div");
    dayCell.classList.add("calendar-day");
    dayCell.innerHTML = `<div class="day-number">${day}</div>`;

    const today = new Date();
    if (
      year === today.getFullYear() &&
      month === today.getMonth() &&
      day === today.getDate()
    ) {
      dayCell.classList.add("current-day");
    }

    const dateStr = `${year}-${String(month + 1).padStart(2, "0")}-${String(
      day
    ).padStart(2, "0")}`;

    // Filter events for this day
    const eventsForDay = studentEvents.filter(
      (ev) => ev.event_date === dateStr
    );

    // Add event pills
    eventsForDay.forEach((event) => {
      const eventDiv = document.createElement("div");
      eventDiv.classList.add("event-pill");
      eventDiv.textContent = event.event_title;
      dayCell.appendChild(eventDiv);

      // Click to edit
      eventDiv.addEventListener("click", (e) => {
        e.stopPropagation();
        openModal(event.event_date, event);
      });
    });

    // Hover tooltip that follows cursor closely
    if (eventsForDay.length > 0) {
      dayCell.addEventListener("mouseenter", (e) => {
        tooltip.style.display = "block";
        tooltip.innerHTML = eventsForDay
          .map((ev) => {
            const timePart = ev.event_time
              ? `<small>🕒 ${ev.event_time}</small><br>`
              : "";
            const descPart = ev.event_description || "";
            return `<strong>${ev.event_title}</strong><br>${timePart}${descPart}`;
          })
          .join("<hr>");
      });

      // Move tooltip to stay right beside the cursor
      dayCell.addEventListener("mousemove", (e) => {
        const offsetX = 12;
        const offsetY = 10;
        tooltip.style.top = e.pageY + offsetY + "px";
        tooltip.style.left = e.pageX + offsetX + "px";
      });

      // Hide tooltip when mouse leaves
      dayCell.addEventListener("mouseleave", () => {
        tooltip.style.display = "none";
      });
    }

    // Click to add new event
    dayCell.addEventListener("click", () => openModal(dateStr));

    calendarGrid.appendChild(dayCell);
  }
}

// Initial render
renderCalendar();

// Month navigation
document.getElementById("prev-month-btn").addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
});

document.getElementById("next-month-btn").addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
});
