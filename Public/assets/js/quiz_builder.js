document.addEventListener("DOMContentLoaded", () => {
  let questionCount = 0;
  const container = document.getElementById("questions-container");
  const addBtn = document.getElementById("addQuestionBtn");

  // Function to add a new question card
  function addQuestion() {
    questionCount++;

    // Create the HTML structure
    const html = `
            <div class="question-card" id="q_card_${questionCount}">
                <button type="button" class="btn-delete-q" onclick="removeQuestion(${questionCount})" title="Remove Question">
                    <i class="fa fa-trash"></i>
                </button>

                <div class="input-group" style="display: flex; align-items: center; gap: 15px;">
                    
                    <span style="font-weight: bold; font-size: 1.2em; color: #555; white-space: nowrap;">
                        Q${questionCount}.
                    </span>

                    <input type="text" 
                           class="form-control" 
                           name="questions[${questionCount}][text]" 
                           placeholder="Type your question here..." 
                           required>
                </div>
                <div class="options-list">
                    <div class="option-item">
                        <label>
                            <input type="radio" name="questions[${questionCount}][correct]" value="0" required>
                            <div class="radio-circle"><i class="fa fa-check" style="color:white; font-size:10px;"></i></div>
                        </label>
                        <input type="text" class="form-control" name="questions[${questionCount}][options][]" placeholder="Option 1" required>
                    </div>

                    <div class="option-item">
                        <label>
                            <input type="radio" name="questions[${questionCount}][correct]" value="1">
                            <div class="radio-circle"><i class="fa fa-check" style="color:white; font-size:10px;"></i></div>
                        </label>
                        <input type="text" class="form-control" name="questions[${questionCount}][options][]" placeholder="Option 2" required>
                    </div>

                    <div class="option-item">
                        <label>
                            <input type="radio" name="questions[${questionCount}][correct]" value="2">
                            <div class="radio-circle"><i class="fa fa-check" style="color:white; font-size:10px;"></i></div>
                        </label>
                        <input type="text" class="form-control" name="questions[${questionCount}][options][]" placeholder="Option 3" required>
                    </div>

                    <div class="option-item">
                        <label>
                            <input type="radio" name="questions[${questionCount}][correct]" value="3">
                            <div class="radio-circle"><i class="fa fa-check" style="color:white; font-size:10px;"></i></div>
                        </label>
                        <input type="text" class="form-control" name="questions[${questionCount}][options][]" placeholder="Option 4" required>
                    </div>
                </div>
            </div>
        `;

    // Append to container
    container.insertAdjacentHTML("beforeend", html);

    // Smooth scroll to the new card
    const newCard = document.getElementById(`q_card_${questionCount}`);
    if (newCard) {
      newCard.scrollIntoView({ behavior: "smooth", block: "center" });
      // Focus on the question input
      newCard.querySelector('input[type="text"]').focus();
    }
  }

  // Attach click event to the "Add Question" button
  if (addBtn) {
    addBtn.addEventListener("click", addQuestion);
  }

  // Initialize with one empty question
  addQuestion();
});

// Global function for the inline onclick handler (Delete button)
window.removeQuestion = function (id) {
  const card = document.getElementById(`q_card_${id}`);
  if (card) {
    card.remove();
  }
};
