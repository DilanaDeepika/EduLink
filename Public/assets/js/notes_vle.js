
// Select all accordion headers
const headers = document.querySelectorAll(".accordion-header");

headers.forEach(header => {
  header.addEventListener("click", () => {
    const accordion = header.parentElement;
    const content = accordion.querySelector(".accordion-content");
    const arrow = header.querySelector(".arrow");

    // Toggle current accordion
    const isOpen = content.classList.contains("show");
    content.classList.toggle("show", !isOpen);

    // Rotate arrow when open
    if (!isOpen) {
      arrow.innerHTML = "&#9662;"; // Down arrow
    } else {
      arrow.innerHTML = "&#9656;"; // Right arrow
    }

    // Optional: close other accordions
    headers.forEach(otherHeader => {
      if (otherHeader !== header) {
        otherHeader.parentElement.querySelector(".accordion-content").classList.remove("show");
        otherHeader.querySelector(".arrow").innerHTML = "&#9656;"; // Reset arrow
      }
    });
  });
});