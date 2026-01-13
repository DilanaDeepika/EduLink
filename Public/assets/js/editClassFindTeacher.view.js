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

document.getElementById("save-changes-btn").addEventListener("click", function() {
    // Collect all teacher requests
    const teacherCards = document.querySelectorAll(".teacher-card");
    const savedData = [];

    teacherCards.forEach(card => {
        const teacherName = card.querySelector(".teacher-name").textContent;
        const subject = card.querySelector(".teacher-subject span").textContent;
        const requestButton = card.querySelector(".btn-primary");
        const requestStatus = requestButton.disabled ? "Pending" : "Not Requested";

        savedData.push({
            teacherName,
            subject,
            requestStatus
        });
    });

    console.log("💾 Saved Data (mock):", savedData);
    alert("✅ Changes saved successfully! (Mock test, no backend)");
});
