document.addEventListener("DOMContentLoaded", () => {
  // --- TAB SWITCHING LOGIC ---
  const tabs = document.querySelectorAll(".tabs .tab");
  const panels = document.querySelectorAll(".panel");
  const indicator = document.querySelector(".tab-indicator");

  /**
   * Moves the yellow indicator bar under the active tab.
   * @param {HTMLElement} activeTab - The currently active tab element.
   */
  function updateIndicator(activeTab) {
    if (!activeTab || !indicator) return;
    const { left, width } = activeTab.getBoundingClientRect();
    const parentLeft = activeTab.parentElement.getBoundingClientRect().left;
    indicator.style.width = `${width}px`;
    indicator.style.left = `${left - parentLeft}px`;
  }

  // Set the initial position of the indicator on page load
  const initialActiveTab = document.querySelector(".tabs .tab.active");
  if (initialActiveTab) {
    updateIndicator(initialActiveTab);
  }

  // Add click event listeners to each tab
  tabs.forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault(); // Prevent page from reloading

      // Deactivate all other tabs and panels
      tabs.forEach((t) => t.classList.remove("active"));
      panels.forEach((p) => p.classList.remove("active"));

      // Activate the clicked tab and its corresponding content panel
      tab.classList.add("active");
      const targetPanelId = tab.getAttribute("data-target");
      document.getElementById(targetPanelId).classList.add("active");

      // Move the indicator to the new active tab
      updateIndicator(tab);
    });
  });

  // --- ACCORDION (DROPDOWN) LOGIC for the 'Notes' panel ---
  const accordionButtons = document.querySelectorAll(".section-header-button");

  accordionButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const sectionBody = button.nextElementSibling; // The content div below the button

      // Toggle the 'open' class on the button to rotate the arrow icon
      button.classList.toggle("open");

      // Toggle the 'hidden' class on the content body to show/hide it
      if (sectionBody) {
        sectionBody.classList.toggle("hidden");
      }
    });
  });
});
