 document.addEventListener('DOMContentLoaded', function() {

  //Handle Next button click
  const btnNext = document.getElementById('btn_next-intended');
  if (btnNext) {
    btnNext.addEventListener('click', function(event) {
      event.preventDefault(); // stop form submission
      show('view-core'); // move to Basic Information section
    });
  }

  //Add new objective input
  window.addObjective = function() {
    const container = document.getElementById('objectives-container');
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-input';
    input.placeholder = 'Objective';
    container.appendChild(input);
  }

});

// Add click listener for "+ Add more" button
  const addBtn = document.getElementById('add-objective');
  addBtn.addEventListener('click', window.addObjective);

  // Handle Save Changes button
  const btnSave = document.getElementById('btn-saveChange-intended');
  btnSave.addEventListener('click', function() {
    // Get all learning objectives
    const objectives = Array.from(document.querySelectorAll('#objectives-container .form-input'))
                            .map(input => input.value.trim())
                            .filter(val => val.length > 0);

    // Get intended learners description
    const intendedFor = document.getElementById('intended-for').value.trim();

    // Get prerequisites
    const prerequisites = document.getElementById('prerequisites').value.trim();

    // Prepare data object
    const data = {
      learningObjectives: objectives,
      intendedFor: intendedFor,
      prerequisites: prerequisites
    };

    // Mock save - Replace with API call if needed
    console.log("Saved Intended Learners Data:", data);
    alert("✅ Intended Learners info saved successfully (mock).");
  });

