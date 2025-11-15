document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll(".nav-item");
  const contentPanels = document.querySelectorAll(".content-panel");
  const mainHeader = document.getElementById("main-header");
  const mainSubheader = document.getElementById("main-subheader");

  // Subheader text for each panel
  const subheaders = {
    "student-details": "View and manage student information.",
    "academic-details": "Class information, schedules and marking panels.",
    "profit": "Track income, expenses, and profitability.",
    "performance": "Analyze overall performance metrics.",
  };

  navItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault();

      // Remove active class from all nav items
      navItems.forEach((nav) => nav.classList.remove("active"));

      // Add active class to the clicked item
      this.classList.add("active");

      // Get the target panel ID from the data attribute
      const targetId = this.querySelector("a").getAttribute("data-target");
      const targetPanel = document.getElementById(targetId);

      // Update header text
      mainHeader.textContent = this.querySelector("a").textContent;
      mainSubheader.textContent = subheaders[targetId] || "";

      // Hide all content panels
      contentPanels.forEach((panel) => panel.classList.remove("active"));

      // Show the target panel
      if (targetPanel) {
        targetPanel.classList.add("active");
      }
    });
  });
});
