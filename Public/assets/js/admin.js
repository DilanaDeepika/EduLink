document.addEventListener("DOMContentLoaded", function () {
  // --- 1. VIEW SWITCHING LOGIC (Analytics vs. Acception, etc.) ---
  const navLinks = document.querySelectorAll(".sidebar .nav-item a");
  const contentSections = document.querySelectorAll(".content-section");
  const navItems = document.querySelectorAll(".sidebar .nav-item");

  navLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const targetId = this.getAttribute("data-target");
      if (!targetId) return;

      navItems.forEach((item) => item.classList.remove("active"));
      this.parentElement.classList.add("active");

      contentSections.forEach((section) => {
        section.classList.toggle("active", section.id === targetId);
      });
    });
  });

  // --- 2. TAB SWITCHING LOGIC (within Acception page) ---
  const tabLinks = document.querySelectorAll(".tab-link");
  const tabContents = document.querySelectorAll(".tab-content");

  tabLinks.forEach((link) => {
    link.addEventListener("click", function () {
      const targetTab = this.getAttribute("data-tab");
      tabLinks.forEach((item) => item.classList.remove("active"));
      this.classList.add("active");
      tabContents.forEach((content) => {
        content.classList.toggle("active", content.id === targetTab);
      });
    });
  });

  // --- 3. ORIGINAL MODAL CONTROL (for Acception page) ---
  const reviewModal = document.getElementById("reviewModal");
  const reviewButtons = document.querySelectorAll(
    ".btn-review:not(.btn-review-ad)"
  );
  const reviewCloseButton = reviewModal.querySelector(".close-button");

  reviewButtons.forEach((button) => {
    button.addEventListener("click", () => {
      reviewModal.style.display = "flex";
    });
  });

  if (reviewCloseButton) {
    reviewCloseButton.addEventListener("click", () => {
      reviewModal.style.display = "none";
    });
  }

  // --- 4. NEW MODAL CONTROL (for Advertisement page) ---
  const adModal = document.getElementById("adReviewModal");
  const adReviewButtons = document.querySelectorAll(".btn-review-ad");
  const adCloseButton = adModal.querySelector(".close-button");

  adReviewButtons.forEach((button) => {
    button.addEventListener("click", () => {
      adModal.style.display = "flex";
    });
  });

  if (adCloseButton) {
    adCloseButton.addEventListener("click", () => {
      adModal.style.display = "none";
    });
  }

  // --- 5. Close either modal when clicking the background overlay ---
  window.addEventListener("click", (event) => {
    if (event.target == reviewModal) {
      reviewModal.style.display = "none";
    }
    if (event.target == adModal) {
      adModal.style.display = "none";
    }
  });
});
