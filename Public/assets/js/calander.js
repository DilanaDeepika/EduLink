// ---------------- GLOBAL ELEMENTS ----------------
const calendarGrid = document.getElementById("calendar-grid");
const currentMonthYear = document.getElementById("current-month-year");
const eventModal = document.getElementById("event-modal");
const closeBtn = eventModal.querySelector(".close-btn");
const cancelBtn = document.getElementById("cancel-btn");

const eventDateInput = document.getElementById("event-date");
const eventTitleInput = document.getElementById("event-title");
const eventDescriptionInput = document.getElementById("event-description");
const eventTimeInput = document.getElementById("event-time");
const eventIdInput = document.getElementById("event-id");

const tooltip = document.getElementById("event-tooltip");

let currentDate = new Date();

// ---------------- MODAL ----------------
function openModal(dateStr, event = null) {
  const saveBtn = eventModal.querySelector('button[type="submit"]');

  // Reset
  eventTitleInput.value = "";
  eventDescriptionInput.value = "";
  eventTimeInput.value = "";
  eventDateInput.value = dateStr;
  eventIdInput.value = "";

  if (event) {
    eventTitleInput.value = event.event_title || "";
    eventDescriptionInput.value = event.event_description || "";
    eventTimeInput.value = event.event_time || "";
    eventIdInput.value = event.event_id;

    eventModal.querySelector("h3").textContent = "Edit Event";

    saveBtn.textContent = "Update";
    saveBtn.onclick = (e) => {
      e.preventDefault();
      updateEvent(event.event_id);
    };

    cancelBtn.textContent = "Delete";
    cancelBtn.onclick = () => deleteEvent(event.event_id);
  } else {
    eventModal.querySelector("h3").textContent = "Add Event";
    saveBtn.textContent = "Save";
    saveBtn.onclick = null;
    cancelBtn.textContent = "Cancel";
    cancelBtn.onclick = closeModal;
  }

  eventModal.style.display = "block";
}

function closeModal() {
  eventModal.style.display = "none";
}

closeBtn.onclick = closeModal;
cancelBtn.onclick = closeModal;

window.onclick = (e) => {
  if (e.target === eventModal) closeModal();
};

// ---------------- DELETE ----------------
function deleteEvent(eventId) {
  fetch(`${appRoot}/StudentProfile/delete_event`, {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `event_id=${eventId}`,
  })
    .then((res) => res.text())
    .then((res) => {
      if (res.includes("success")) {
        studentEvents = studentEvents.filter(
          (e) => e.event_id != eventId
        );
        closeModal();
        renderCalendar();
      } else {
        alert("Delete failed");
      }
    });
}

// ---------------- UPDATE ----------------
function updateEvent(eventId) {
  const formData = new FormData(document.getElementById("event-form"));

  fetch(`${appRoot}/StudentProfile/update_event`, {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((res) => {
      if (res.includes("success")) {
        const index = studentEvents.findIndex(
          (e) => e.event_id == eventId
        );

        if (index > -1) {
          studentEvents[index].event_title =
            formData.get("event_title");
          studentEvents[index].event_date =
            formData.get("event_date");
          studentEvents[index].event_time =
            formData.get("event_time");
          studentEvents[index].event_description =
            formData.get("event_description");
        }

        closeModal();
        renderCalendar();
      } else {
        alert("Update failed");
      }
    });
}

// ---------------- CALENDAR RENDER ----------------
function renderCalendar() {
  calendarGrid.innerHTML = "";

  const month = currentDate.getMonth();
  const year = currentDate.getFullYear();

  currentMonthYear.textContent = new Intl.DateTimeFormat("en-US", {
    year: "numeric",
    month: "long",
  }).format(currentDate);

  // Weekdays
  ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"].forEach((d) => {
    const w = document.createElement("div");
    w.classList.add("calendar-weekday");
    w.textContent = d;
    calendarGrid.appendChild(w);
  });

  const firstDay = new Date(year, month, 1).getDay();
  for (let i = 0; i < firstDay; i++) {
    calendarGrid.appendChild(document.createElement("div"));
  }

  const daysInMonth = new Date(year, month + 1, 0).getDate();

  for (let day = 1; day <= daysInMonth; day++) {
    const cell = document.createElement("div");
    cell.classList.add("calendar-day");
    cell.innerHTML = `<div class="day-number">${day}</div>`;

    const dateStr = `${year}-${String(month + 1).padStart(2, "0")}-${String(
      day
    ).padStart(2, "0")}`;

    const eventsForDay = studentEvents.filter(
      (e) => e.event_date === dateStr
    );

    eventsForDay.forEach((event) => {
      const pill = document.createElement("div");
      pill.classList.add("event-pill");
      pill.textContent = event.event_title;

      pill.onclick = (e) => {
        e.stopPropagation();
        openModal(event.event_date, event);
      };

      cell.appendChild(pill);
    });

    // Tooltip
    if (eventsForDay.length) {
      cell.onmouseenter = () => {
        tooltip.style.display = "block";
        tooltip.innerHTML = eventsForDay
          .map(
            (e) =>
              `<strong>${e.event_title}</strong><br>
               ${e.event_time ? "🕒 " + e.event_time + "<br>" : ""}
               ${e.event_description || ""}`
          )
          .join("<hr>");
      };

      cell.onmousemove = (e) => {
        tooltip.style.left = e.pageX + 12 + "px";
        tooltip.style.top = e.pageY + 10 + "px";
      };

      cell.onmouseleave = () => {
        tooltip.style.display = "none";
      };
    }

    cell.onclick = () => openModal(dateStr);
    calendarGrid.appendChild(cell);
  }
}

// ---------------- INIT ----------------
renderCalendar();

document.getElementById("prev-month-btn").onclick = () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
};

document.getElementById("next-month-btn").onclick = () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
};
