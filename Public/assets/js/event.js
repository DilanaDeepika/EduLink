// ----- Modal open function -----
function openEventModal(date) {
  const modal = document.getElementById("eventModal");
  modal.style.display = "flex";
  document.getElementById("eventDate").value = date;
  document.getElementById("eventTitle").value = "";
  document.getElementById("eventStart").value = "09:00";
  document.getElementById("eventEnd").value = "10:00";
  document.getElementById("eventColor").value = "#FED352";
}

// ----- Close modal -----
document.getElementById("closeModal").addEventListener("click", () => {
  document.getElementById("eventModal").style.display = "none";
});
window.addEventListener("click", (e) => {
  if (e.target.id === "eventModal")
    document.getElementById("eventModal").style.display = "none";
});

// ----- Save event -----
document.getElementById("eventForm").addEventListener("submit", (e) => {
  e.preventDefault();

  const date = document.getElementById("eventDate").value;
  const newEvent = {
    id: Date.now(),
    title: document.getElementById("eventTitle").value,
    description: document.getElementById("eventDesc").value, // proper description
    start: date + "T" + document.getElementById("eventStart").value,
    end: date + "T" + document.getElementById("eventEnd").value,
    color: document.getElementById("eventColor").value,
  };

  eventsData.push(newEvent); // add to events array
  document.getElementById("eventModal").style.display = "none";
  render(); // refresh the calendar
});

// ----- Helper function to attach day click events -----
// Call this AFTER render() in calander.js
function attachDayClickHandlers() {
  // Month view: click on day cell
  document.querySelectorAll(".month-table td").forEach((td) => {
    td.addEventListener("click", () => {
      const dayNumber = td.querySelector(".day-number")?.textContent;
      if (!dayNumber) return;
      const month = currentDate.getMonth() + 1;
      const year = currentDate.getFullYear();
      const dateStr = `${year}-${pad(month)}-${pad(dayNumber)}`;
      openEventModal(dateStr);
    });
  });

  // Week view: click on day column
  document.querySelectorAll(".day-column").forEach((col) => {
    col.addEventListener("click", () => {
      const dateStr = col.getAttribute("data-day");
      openEventModal(dateStr);
    });
  });
}
