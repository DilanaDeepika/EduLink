document.addEventListener("DOMContentLoaded", function () {
  // 1. Select all necessary elements
  const buttons = document.querySelectorAll(".home-subject-btn");
  const cards = document.querySelectorAll(".class-card-wrapper");
  const container = document.getElementById("cards-container");
  const scrollLeftBtn = document.getElementById("scrollLeft");
  const scrollRightBtn = document.getElementById("scrollRight");

  // 2. Define the Filter Function
  function filterCards(category) {
    let hasVisibleCards = false;

    // Loop through all cards to show/hide based on category
    cards.forEach((card) => {
      // We use trim() to handle any accidental whitespace in the HTML
      const cardSubject = card.dataset.subject
        ? card.dataset.subject.trim()
        : "";

      if (cardSubject === category.trim()) {
        card.classList.remove("hidden"); // Show card
        hasVisibleCards = true;
      } else {
        card.classList.add("hidden"); // Hide card
      }
    });

    // Reset scroll position to the start when switching categories
    if (container) {
      container.scrollLeft = 0;
    }

    // Update Button Styling (Visual Feedback)
    buttons.forEach((btn) => {
      const btnSubject = btn.dataset.subject ? btn.dataset.subject.trim() : "";

      if (btnSubject === category.trim()) {
        // Active Styles (Primary Color: #1E2A5E)
        btn.style.backgroundColor = "#1E2A5E";
        btn.style.color = "#ffffff";
        btn.classList.add("active"); // Optional: Add a class for CSS handling
      } else {
        // Reset Styles
        btn.style.backgroundColor = "";
        btn.style.color = "";
        btn.classList.remove("active");
      }
    });
  }

  // 3. Add Click Events to Subject Buttons
  buttons.forEach((button) => {
    button.addEventListener("click", function () {
      const subject = this.dataset.subject;
      if (subject) {
        filterCards(subject);
      }
    });
  });

  // 4. Scroll Buttons Logic (Left/Right)
  if (container) {
    if (scrollLeftBtn) {
      scrollLeftBtn.addEventListener("click", () => {
        container.scrollBy({ left: -300, behavior: "smooth" });
      });
    }

    if (scrollRightBtn) {
      scrollRightBtn.addEventListener("click", () => {
        container.scrollBy({ left: 300, behavior: "smooth" });
      });
    }
  }
  
  if (buttons.length > 0) {
    buttons[0].click();

    const slides = document.querySelectorAll(".hero-slider .slide");

    // Only run if we have more than 1 image
    if (slides.length > 1) {
      let currentSlide = 0;

      setInterval(() => {
        slides[currentSlide].classList.remove("active");

        currentSlide = (currentSlide + 1) % slides.length;

        slides[currentSlide].classList.add("active");
      }, 4000);
    }
  }
});
