document.addEventListener("DOMContentLoaded", function () {
  // Find the button by its new ID
  const addObjectiveButton = document.getElementById("add-objective-btn");

  // This is the function that creates a new input field
  function addObjective() {
    const container = document.getElementById("objectives-container");
    const input = document.createElement("input");
    input.type = "text";
    input.className = "form-input";
    input.placeholder = "Objective";
    input.name = "learning_objectives[]";
    container.appendChild(input);
  }

  // If the button exists on the page, attach the click event
  if (addObjectiveButton) {
    addObjectiveButton.addEventListener("click", addObjective);
  }
});
