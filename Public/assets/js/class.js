document.addEventListener("DOMContentLoaded", () => {
  // Get all the elements needed for the popup functionality
  const applyButton = document.getElementById("apply-free-card-btn");
  const popup = document.getElementById("free-card-popup");
  const closeButton = document.getElementById("close-popup-btn");
  const applicationForm = document.getElementById("free-card-form");
  const fileInput = document.getElementById("proof-document");
  const fileNameDisplay = document.getElementById("file-name-display");

  // Safety check to ensure all elements exist on the page
  if (
    applyButton &&
    popup &&
    closeButton &&
    applicationForm &&
    fileInput &&
    fileNameDisplay
  ) {
    // --- Popup Visibility ---

    // Show the popup when the "Apply" button is clicked
    applyButton.addEventListener("click", () => {
      popup.style.display = "flex";
    });

    // Hide the popup when the "Cancel" button is clicked
    closeButton.addEventListener("click", () => {
      popup.style.display = "none";
    });

    // --- File Input Functionality ---

    // Listen for a change on the hidden file input to display the filename
    fileInput.addEventListener("change", function () {
      if (this.files.length > 0) {
        // If a file is selected, show its name
        fileNameDisplay.textContent = this.files[0].name;
      } else {
        // If no file is selected, show the default text
        fileNameDisplay.textContent = "No file selected.";
      }
    });

    // --- Form Submission (Test Version) ---

    // Handle the form submission when the user clicks "Submit Application"
    applicationForm.addEventListener("submit", (event) => {
      // event.preventDefault(); // Stop the page from reloading

      const formData = new FormData(applicationForm);
      const file = formData.get("proof_document");

      // Check if a file was actually selected
      if (file && file.size > 0) {
        // Simulate a 1.5-second server delay for testing
        setTimeout(() => {
          alert("Application submitted successfully! (This is a test)");
          popup.style.display = "none"; // Hide the popup
          applicationForm.reset(); // Clear the form fields
          fileNameDisplay.textContent = "No file selected."; // Reset the filename display
        }, 1500);
      } else {
        alert("Please select a file to upload.");
      }
    });
  } else {
    // Log an error if any of the required elements are missing
    console.error(
      "One or more elements for the popup functionality were not found!"
    );
  }
});

document.addEventListener("DOMContentLoaded", () => {
    const registerBtn = document.getElementById('registerInstituteBtn');
    const institutePopup = document.getElementById('institute-popup');
    const closeInstituteBtn = document.getElementById('closeInstitutePopup');

    if (registerBtn && institutePopup && closeInstituteBtn) {
registerBtn.addEventListener('click', () => {
    institutePopup.style.display = 'flex';
});

closeInstituteBtn.addEventListener('click', () => {
    institutePopup.style.display = 'none';
});
    } else {
        console.error('Register button or popup elements missing!');
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const payBtn = document.getElementById("payNowBtn");
    const paymentModal = document.getElementById("paymentModal");
    const cancelBtn = paymentModal?.querySelector("button[type='button']");

    if (!payBtn || !paymentModal) {
        console.error("Pay Now button or modal missing!");
        return;
    }

    // Show modal
    payBtn.addEventListener("click", (e) => {
        e.preventDefault();
        paymentModal.classList.add("active");
    });

    // Close modal with cancel button
    cancelBtn?.addEventListener("click", () => {
        paymentModal.classList.remove("active");
    });

    // Close modal when clicking outside modal-content
    paymentModal.addEventListener("click", (e) => {
        if (e.target === paymentModal) {
            paymentModal.classList.remove("active");
        }
    });
});






