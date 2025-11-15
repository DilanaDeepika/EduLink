document.addEventListener("DOMContentLoaded", function () {
  // Get all content views
  const views = document.querySelectorAll(".view");

  // Function to show a specific panel
  function showPanel(targetId) {
    // First, hide all the views
    views.forEach((view) => {
      view.hidden = true;
    });

    // Remove 'active' class from all sidebar items
    document.querySelectorAll(".sidebar-item").forEach((item) => {
      item.classList.remove("active");
    });

    // Show the target view
    const viewToShow = document.getElementById(targetId);
    if (viewToShow) {
      viewToShow.hidden = false;
    }

    // Add 'active' class to the corresponding sidebar item
    const activeItem = document.querySelector(
      `.sidebar-item[data-target="${targetId}"]`
    );
    if (activeItem) {
      activeItem.classList.add("active");
    }
  }

  // This is the key change: Listen for clicks on the whole document
  document.addEventListener("click", function (event) {
    // Find the closest ancestor element with a 'data-target' attribute
    const targetElement = event.target.closest("[data-target]");

    // If such an element was clicked...
    if (targetElement) {
      const targetId = targetElement.dataset.target;
      showPanel(targetId);
    }
  });

  // Show the first panel automatically when the page loads
  const firstItem = document.querySelector(".sidebar-item");
  if (firstItem) {
    showPanel(firstItem.dataset.target);
  }
});
