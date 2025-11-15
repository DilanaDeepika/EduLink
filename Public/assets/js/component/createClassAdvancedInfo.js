document.addEventListener("DOMContentLoaded", function () {
  // ---------- File Upload Logic (Image) ----------
  const imageBtn = document.querySelector(
    ".media-item:first-child .upload-btn"
  );
  const thumbnailInput = document.getElementById("thumbnail-input");
  const thumbnailName = document.getElementById("thumbnail-name");

  if (imageBtn) {
    imageBtn.addEventListener("click", () => thumbnailInput.click());
  }
  if (thumbnailInput) {
    thumbnailInput.addEventListener("change", function () {
      const file = this.files[0];
      thumbnailName.style.display = file ? "block" : "none";
      thumbnailName.textContent = file ? `Selected: ${file.name}` : "";
    });
  }

  // ---------- File Upload Logic (Video) ----------
  const videoBtn = document.querySelector(
    ".media-item:nth-child(2) .upload-btn"
  );
  const videoInput = document.getElementById("video-input");
  const videoName = document.getElementById("video-name");

  if (videoBtn) {
    videoBtn.addEventListener("click", () => videoInput.click());
  }
  if (videoInput) {
    videoInput.addEventListener("change", function () {
      const file = this.files[0];
      videoName.style.display = file ? "block" : "none";
      videoName.textContent = file ? `🎬 Selected: ${file.name}` : "";
    });
  }

  // ---------- NEW: Dynamic Time Slot Logic ----------
  const dayCheckboxes = document.querySelectorAll(
    '.days-selector input[type="checkbox"]'
  );

  dayCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const day = this.value;
      const timeSlot = document.querySelector(`.time-slot[data-day="${day}"]`);

      if (timeSlot) {
        timeSlot.hidden = !this.checked;
      }
    });
  });
});
