/* calendar.js
   - month / week toggles
   - prev/next navigation
   - week view: scrollable grid with events
   - hover shows event descriptions
*/

/* ================= sample events ================= */
let eventsData = [];
/* ================================================== */

let currentView = "month";
let currentDate = new Date();
const HOUR_HEIGHT = 60; // pixels per hour in week view

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("btnMonth")
    .addEventListener("click", () => setView("month"));
  document
    .getElementById("btnWeek")
    .addEventListener("click", () => setView("week"));
  document.getElementById("prevBtn").addEventListener("click", prev);
  document.getElementById("nextBtn").addEventListener("click", next);
  document.getElementById("todayBtn").addEventListener("click", () => {
    currentDate = new Date();
    render();
  });

  updateActiveToggle();
  render();
});

function setView(view) {
  currentView = view;
  updateActiveToggle();
  render();
}

function updateActiveToggle() {
  document
    .querySelectorAll(".view-toggle button")
    .forEach((b) => b.classList.remove("active"));
  if (currentView === "month")
    document.getElementById("btnMonth").classList.add("active");
  if (currentView === "week")
    document.getElementById("btnWeek").classList.add("active");
}

function prev() {
  if (currentView === "month") currentDate.setMonth(currentDate.getMonth() - 1);
  if (currentView === "week") currentDate.setDate(currentDate.getDate() - 7);
  render();
}

function next() {
  if (currentView === "month") currentDate.setMonth(currentDate.getMonth() + 1);
  if (currentView === "week") currentDate.setDate(currentDate.getDate() + 7);
  render();
}

/* --- main render --- */
function render() {
  const cal = document.getElementById("calendar");
  cal.innerHTML = "";

  if (currentView === "month") renderMonthView(cal);
  else renderWeekView(cal);

  attachDayClickHandlers();
}

/* ================= MONTH VIEW ================= */
function renderMonthView(container) {
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  document.getElementById(
    "date-range"
  ).textContent = `${currentDate.toLocaleString("default", {
    month: "long",
  })} ${year}`;

  const firstDayOfMonth = new Date(year, month, 1);
  const startWeekday = firstDayOfMonth.getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  let html = '<table class="month-table"><thead><tr>';
  ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"].forEach(
    (n) => (html += `<th>${n}</th>`)
  );
  html += "</tr></thead><tbody><tr>";

  for (let i = 0; i < startWeekday; i++) html += "<td></td>";

  for (let d = 1; d <= daysInMonth; d++) {
    const fullDate = `${year}-${pad(month + 1)}-${pad(d)}`;
    const dayEvents = eventsData.filter((ev) => evStartsOn(ev, fullDate));

    let pillsHtml = "";
    const maxVisible = 2; // max visible events
    dayEvents.slice(0, maxVisible).forEach((ev) => {
      pillsHtml += `<div class="event-pill" 
                    title="${escapeHtml(ev.description)}" 
                    style="background: ${ev.color || "#FED352"}"
                    data-description="${escapeHtml(ev.description)}">
                    ${escapeHtml(ev.title)}
                </div>`;
    });

    if (dayEvents.length > maxVisible) {
      pillsHtml += `<div class="more-pill" data-date="${fullDate}">+${
        dayEvents.length - maxVisible
      } more</div>`;
    }

    html += `<td>
               <div class="day-number">${d}</div>
               <div class="events-container">${pillsHtml}</div>
             </td>`;

    if ((d + startWeekday) % 7 === 0) html += "</tr><tr>";
  }

  const trailing = (7 - ((daysInMonth + startWeekday) % 7)) % 7;
  for (let i = 0; i < trailing; i++) html += "<td></td>";

  html += "</tr></tbody></table>";
  container.innerHTML = html;

  document.querySelectorAll(".more-pill").forEach((pill) => {
    pill.addEventListener("click", (e) => {
      const date = e.target.getAttribute("data-date");
      const dayEvents = eventsData.filter((ev) => evStartsOn(ev, date));
      alert(
        `Events on ${date}:\n` +
          dayEvents.map((ev) => "- " + ev.title).join("\n")
      );
    });
  });
}

/* ================= WEEK VIEW ================= */
function renderWeekView(container) {
  const ref = new Date(currentDate);
  const startOfWeek = new Date(ref);
  startOfWeek.setDate(ref.getDate() - ref.getDay());

  const endOfWeek = new Date(startOfWeek);
  endOfWeek.setDate(startOfWeek.getDate() + 6);

  const fmt = (d) => d.toLocaleDateString();
  document.getElementById("date-range").textContent = `${fmt(
    startOfWeek
  )} — ${fmt(endOfWeek)}`;

  let html = '<div class="week-wrapper">';
  html += '<div class="week-days-header"><div class="time-col-header"></div>';
  for (let i = 0; i < 7; i++) {
    const day = new Date(startOfWeek);
    day.setDate(startOfWeek.getDate() + i);
    html += `<div class="day-header">${day.toLocaleString("default", {
      weekday: "short",
    })}<br><span style="font-weight:600">${day.getDate()}</span></div>`;
  }
  html += "</div>";

  html += '<div class="week-scroll"><div class="time-col" aria-hidden="true">';
  for (let h = 0; h < 24; h++)
    html += `<div class="time-slot">${formatHour(h)}</div>`;
  html += "</div>";

  html += '<div class="days-columns">';
  for (let i = 0; i < 7; i++) {
    const day = new Date(startOfWeek);
    day.setDate(startOfWeek.getDate() + i);
    const dayKey = dayToKey(day);
    html += `<div class="day-column" data-day="${dayKey}" style="min-height:${
      24 * HOUR_HEIGHT
    }px;position:relative">`;
    for (let h = 0; h < 24; h++)
      html += `<div class="hour-line" style="top:${h * HOUR_HEIGHT}px"></div>`;
    html += "</div>";
  }
  html += "</div></div></div>";

  container.innerHTML = html;
  placeEventsInWeek(startOfWeek);
}

/* ====== PLACE EVENTS IN WEEK ====== */
function placeEventsInWeek(startOfWeek) {
  eventsData.forEach((ev) => {
    const evStart = new Date(ev.start);
    const evEnd = new Date(ev.end || ev.start);

    const dayKey = dayToKey(evStart);
    const dayCol = document.querySelector(`.day-column[data-day="${dayKey}"]`);
    if (!dayCol) return;

    const dayStart = new Date(
      evStart.getFullYear(),
      evStart.getMonth(),
      evStart.getDate()
    );
    const minutesFromMidnight = (evStart - dayStart) / 60000;
    const durationMinutes = Math.max(15, (evEnd - evStart) / 60000);

    const topPx = (minutesFromMidnight / 60) * HOUR_HEIGHT;
    const heightPx = (durationMinutes / 60) * HOUR_HEIGHT;

    const div = document.createElement("div");
    div.className = "event-box";
    div.style.top = `${topPx}px`;
    div.style.height = `${heightPx}px`;
    div.style.background = ev.color || "var(--accent)";
    div.style.position = "absolute";
    div.textContent = ev.title;

    // Add tooltip for hover
    div.setAttribute("title", ev.description); // native browser tooltip
    div.setAttribute("data-description", ev.description); // optional for custom CSS tooltip

    dayCol.appendChild(div);
  });
}

/* ================= HELPERS ================= */
function pad(n) {
  return String(n).padStart(2, "0");
}
function dayToKey(d) {
  return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
}
function evStartsOn(ev, dateKey) {
  return dayToKey(new Date(ev.start)) === dateKey;
}
function formatHour(h) {
  const am = h < 12;
  const hh = h % 12 === 0 ? 12 : h % 12;
  return `${hh} ${am ? "AM" : "PM"}`;
}
function escapeHtml(s) {
  return String(s).replace(
    /[&<>"]/g,
    (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;" }[c])
  );
}

/* ====== Attach day click handlers for modal ====== */
function attachDayClickHandlers() {
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

  document.querySelectorAll(".day-column").forEach((col) => {
    col.addEventListener("click", () => {
      const dateStr = col.getAttribute("data-day");
      openEventModal(dateStr);
    });
  });
}
