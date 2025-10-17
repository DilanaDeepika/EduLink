document.addEventListener("DOMContentLoaded", () => {
  // Existing tab and section code
  const tabs = document.querySelectorAll(".vle-tab");
  const panels = document.querySelectorAll(".vle-panel");

  // Load the external popup HTML dynamically
  fetch("../views/content_gen_view.html")
    .then((response) => response.text())
    .then((html) => {
      document.body.insertAdjacentHTML("beforeend", html);
    })
    .catch((err) => console.error("Error loading document popup:", err));

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      const targetPanel = tab.getAttribute("data-panel");
      tabs.forEach((t) => t.classList.remove("active"));
      panels.forEach((p) => p.classList.remove("active"));
      tab.classList.add("active");
      document.getElementById(targetPanel).classList.add("active");
    });
  });

  document.querySelectorAll(".section-header-button").forEach((button) => {
    button.addEventListener("click", () => {
      button.classList.toggle("open");
      const sectionBody = button.closest(".section-header").nextElementSibling;
      sectionBody.classList.toggle("hidden");
    });
  });

  // --- Popup functions ---
  const popup = document.getElementById("popupWindow");
  console.log(popup);

  // Open popup (called from your button onclick)
  window.openPopup = function () {
    if (popup) popup.style.display = "block";
  };

  // Close popup
  window.closePopup = function () {
    if (popup) popup.style.display = "none";
  };

  // Close popup when clicking outside
  window.addEventListener("click", (event) => {
    if (event.target === popup) {
      popup.style.display = "none";
    }
  });
  window.chooseContent = function (type) {
    const panelCreate = document.getElementById(type);
    if (panelCreate) {
      panelCreate.style.display = "block";

      // Add click listener to close when clicking outside content
      panelCreate.addEventListener("click", function (event) {
        // Only close if clicked on overlay (not inner content)
        if (event.target === panelCreate) {
          panelCreate.style.display = "none";
        }
      });
    }
  };
  window.closeCreatePopup = function (type) {
    const panelCreate = document.getElementById(type);
    if (panelCreate) {
      panelCreate.style.display = "none";
    }
  };
});

//===========================================================
// ALL FUNCTIONS FOR YOUR POPUPS CAN GO HERE
//===========================================================

/**
 * Dynamically generates input fields for questions and answers
 * based on the number entered by the user.
 */
function generateQuestionFields() {
  const numQuestions = document.getElementById("numberOfQuestions").value;
  const container = document.getElementById("questionsContainer");

  // Clear previous fields
  container.innerHTML = "";

  // Only generate fields if the number is valid
  if (numQuestions > 0 && numQuestions <= 20) {
    for (let i = 1; i <= numQuestions; i++) {
      // Create a div for each question block
      const questionBlock = document.createElement("div");
      questionBlock.className = "form-group question-block";

      // Set the inner HTML for the question and its 4 answers
      questionBlock.innerHTML = `
        <h4>Question ${i}</h4>
        <label for="question_text_${i}">Question Text:</label>
        <input type="text" id="question_text_${i}" name="question_${i}" placeholder="Enter the question text" required>

        <label style="margin-top: 10px;">Answers (Select the correct one):</label>
        
        <div class="answer-option">
            <input type="radio" id="q${i}_correct_1" name="correct_answer_${i}" value="1" required>
            <input type="text" name="q${i}_answer_1" placeholder="Answer 1" required>
        </div>
        <div class="answer-option">
            <input type="radio" id="q${i}_correct_2" name="correct_answer_${i}" value="2">
            <input type="text" name="q${i}_answer_2" placeholder="Answer 2" required>
        </div>
        <div class="answer-option">
            <input type="radio" id="q${i}_correct_3" name="correct_answer_${i}" value="3">
            <input type="text" name="q${i}_answer_3" placeholder="Answer 3" required>
        </div>
        <div class="answer-option">
            <input type="radio" id="q${i}_correct_4" name="correct_answer_${i}" value="4">
            <input type="text" name="q${i}_answer_4" placeholder="Answer 4" required>
        </div>
      `;
      // Add the new question block to the container
      container.appendChild(questionBlock);
    }
  }
}

/**
 * Placeholder function for when the "Create Quiz" button is clicked.
 */
function createQuiz() {
  console.log("Create Quiz button clicked!");
  const quizForm = document.getElementById("quizForm");
  if (quizForm.checkValidity()) {
    // Logic to collect all form data and submit it will go here
    alert("Quiz creation logic is next!");
  } else {
    alert("Please fill out all required fields.");
  }
}

/**
 * Placeholder functions for your other popups.
 */
function uploadDocument() {
  console.log("Upload Document button clicked!");
}

function uploadLink() {
  console.log("Upload Link button clicked!");
}
