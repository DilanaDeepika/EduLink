document.addEventListener('DOMContentLoaded', function() {

  //Handle Next button click
  const btnNext = document.getElementById('btn-next-intended');
  
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