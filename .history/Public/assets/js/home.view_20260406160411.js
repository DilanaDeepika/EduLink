document.addEventListener('DOMContentLoaded', function() {
  const subjectButtons = document.querySelectorAll('.home-subject-btn');
  const url = new URL(window.location.href);
  const currentSubject = url.searchParams.get('subject');

  // Highlight the active subject after reload
  subjectButtons.forEach(button => {
    const subject = button.dataset.subject;

    if (subject === currentSubject) {
      button.classList.add('active-subject-btn');
    }

    // Handle button click
    button.addEventListener('click', function() {
      const subject = this.dataset.subject;
      const url = new URL(window.location.href);
      url.searchParams.set('subject', subject);

      // Remove previous highlights
      subjectButtons.forEach(btn => btn.classList.remove('active-subject-btn'));

      // Apply highlight instantly before reload
      this.classList.add('active-subject-btn');

      // Change URL and reload
      window.location.href = url.toString();
    });
  });
  // Scroll to filtered section if subject exists
  if (currentSubject) {
    const section = document.getElementById('home-section home-catergary-container');
    if (section) {
      section.scrollIntoView({ behavior: 'smooth' });
    }
  }
  const container = document.querySelector(".cards-wrapper");
  const leftBtn = document.getElementById("scrollLeft");
  const rightBtn = document.getElementById("scrollRight");


if (container && leftBtn && rightBtn) {
  rightBtn.addEventListener("click", () => {
    container.scrollLeft += 300;
  });

  leftBtn.addEventListener("click", () => {
    container.scrollLeft -= 300;
  });
}

const slider = document.getElementById("heroAdSlider");
  if (slider) {

      let currentAd = 0;
      const slides = slider.children;
      const totalAds = slides.length;

      function rotateAds() {
          if (totalAds > 1) {
              currentAd = (currentAd + 1) % totalAds;
              slider.style.transform = `translateX(-${currentAd * 100}%)`;
          }
      }

      setInterval(rotateAds, 6000);
  }


});
