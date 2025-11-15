document.addEventListener("DOMContentLoaded", function () {
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const contentSections = document.querySelectorAll(".content-section");

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function (event) {
      event.preventDefault(); 

      const targetId = this.getAttribute("data-target");

      sidebarItems.forEach((link) => link.classList.remove("active"));

      this.classList.add("active");


      contentSections.forEach((section) => section.classList.remove("active"));
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.classList.add("active");
      }
    });
  });
});
