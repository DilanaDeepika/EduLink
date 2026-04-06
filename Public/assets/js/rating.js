document.addEventListener("DOMContentLoaded", function () {
  // --- Elements ---
  const reviewModal = document.getElementById("reviewModal");
  const modalRatingInput = document.getElementById("modalRatingInput");
  const writeReviewLink = document.querySelector(".write-review-link");
  const closeModalBtn = document.getElementById("closeReviewModal");

  // Star Groups
  const mainStars = document.querySelectorAll("#user-rating .star");
  const modalStars = document.querySelectorAll(".modal-stars .star");

  let selectedRating = 0;

  // --- 1. Main Page Star Logic ---
  mainStars.forEach((star) => {
    star.addEventListener("click", function () {
      selectedRating = parseInt(this.getAttribute("data-rating"));

      // Sync to hidden input and modal UI
      updateRatingSystem(selectedRating);

      // Open the modal automatically
      openModal();
    });

    star.addEventListener("mouseenter", function () {
      highlightStars(mainStars, parseInt(this.getAttribute("data-rating")));
    });
  });

  document
    .querySelector("#user-rating")
    ?.addEventListener("mouseleave", function () {
      highlightStars(mainStars, selectedRating);
    });

  // --- 2. Modal Star Logic (In case they change rating inside modal) ---
  modalStars.forEach((star) => {
    star.addEventListener("click", function () {
      selectedRating = parseInt(this.getAttribute("data-rating"));
      updateRatingSystem(selectedRating);
    });

    star.addEventListener("mouseenter", function () {
      highlightStars(modalStars, parseInt(this.getAttribute("data-rating")));
    });
  });

  document
    .querySelector(".modal-stars")
    ?.addEventListener("mouseleave", function () {
      highlightStars(modalStars, selectedRating);
    });

  // --- 3. Helper Functions ---

  function updateRatingSystem(rating) {
    selectedRating = rating;

    // Update the hidden input for the form submission
    if (modalRatingInput) {
      modalRatingInput.value = rating;
    }

    // Update all star sets visually
    highlightStars(mainStars, rating);
    highlightStars(modalStars, rating);
  }

  function highlightStars(starGroup, rating) {
    starGroup.forEach((star, index) => {
      star.classList.toggle("filled", index < rating);
    });
  }

  function openModal() {
    if (reviewModal) {
      reviewModal.classList.add("active");
      document.body.style.overflow = "hidden"; // Prevent scrolling
    }
  }

  function closeModal() {
    if (reviewModal) {
      reviewModal.classList.remove("active");
      document.body.style.overflow = "";
      // Optional: Uncomment below if you want to clear the form on close
      // reviewTextarea.value = "";
    }
  }

  // --- 4. Event Listeners ---

  // "Write a review" link
  if (writeReviewLink) {
    writeReviewLink.addEventListener("click", function (e) {
      e.preventDefault();
      openModal();
    });
  }

  // Close button
  if (closeModalBtn) {
    closeModalBtn.addEventListener("click", closeModal);
  }

  // Click outside modal to close
  window.addEventListener("click", function (e) {
    if (e.target === reviewModal) {
      closeModal();
    }
  });

  // Escape key to close
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      closeModal();
    }
  });
});
