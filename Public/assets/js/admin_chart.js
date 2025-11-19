const ctx = document.getElementById("admin-chart");

// Default full week with 0 logins
const fullWeek = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];
const countsByDay = {
  Sunday: 0,
  Monday: 0,
  Tuesday: 0,
  Wednesday: 0,
  Thursday: 0,
  Friday: 0,
  Saturday: 0,
};

// Fill existing data from PHP
weeklyData.forEach((entry) => {
  countsByDay[entry.day] = entry.count;
});

// Convert to arrays for Chart.js
const labels = fullWeek;
const counts = fullWeek.map((day) => countsByDay[day]);

new Chart(ctx, {
  type: "line",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Logins per Day",
        data: counts,
        borderWidth: 2
      },
    ],
  },
  options: {
    scales: {
      y: { beginAtZero: true },
    },
  },
});
