document.addEventListener("DOMContentLoaded", function () {
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const contentSections = document.querySelectorAll(".content-section");

  // Add click event listener to each sidebar link
  sidebarItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent the default link behavior

      const targetId = this.getAttribute("data-target");

      // --- Update Active State in Sidebar ---
      // Remove 'active' class from all sidebar items
      sidebarItems.forEach((link) => link.classList.remove("active"));
      // Add 'active' class to the clicked item
      this.classList.add("active");

      // --- Show the Target Content Section ---
      // Hide all content sections
      contentSections.forEach((section) => section.classList.remove("active"));
      // Show the specific section that matches the data-target
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.classList.add("active");
      }
    });
  });
});
