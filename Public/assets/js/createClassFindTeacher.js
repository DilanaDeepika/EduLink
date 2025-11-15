document.addEventListener("DOMContentLoaded", function() {
    // Select all "Request" buttons
    const requestButtons = document.querySelectorAll(".btn-primary");

    requestButtons.forEach((button) => {
        button.addEventListener("click", function() {
            // Change text and disable the button
            button.textContent = "Request Pending";
            button.disabled = true;

            // Add a visual style for the disabled state
            button.classList.add("pending");
        });
    });
});