document.addEventListener('DOMContentLoaded', function () {

  // ---------- Add new objective ----------
  window.addObjective = function () {
    const container = document.getElementById('objectives-container');
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-input';
    input.placeholder = 'Objective';
    container.appendChild(input);
  };

  // ---------- Handle Save Changes button ----------
  const btnSave = document.querySelector('.btn-save-draft');
  if (btnSave) {
    btnSave.addEventListener('click', function () {
      // Collect learning objectives
      const objectives = Array.from(document.querySelectorAll('#objectives-container input'))
        .map(input => input.value.trim())
        .filter(val => val !== "");

      // Collect textareas
      const textareas = document.querySelectorAll('.form-textarea');
      const learnersText = textareas[0]?.value.trim() || '';
      const prerequisitesText = textareas[1]?.value.trim() || '';

      // Prepare data object
      const data = {
        objectives,
        intendedLearners: learnersText,
        prerequisites: prerequisitesText
      };

      // Save to localStorage (temporary)
      localStorage.setItem('intendedLearnersData', JSON.stringify(data));

      alert('✅ Changes saved successfully!');
    });
  }

  // ---------- Handle Next button ----------
  const btnNext = document.getElementById('btn_next-intended');
  if (btnNext) {
    btnNext.addEventListener('click', function (event) {
      event.preventDefault();

      //Save before moving next
      if (typeof saveIntendedLearners === 'function') {
        saveIntendedLearners();
      }

      // Move to next section if show() is available
      if (typeof show === 'function') {
        show('view-core');
      } else {
        console.warn("⚠️ The 'show()' function is not defined. Make sure it's included from your main view controller.");
      }
    });
  }

  // ---------- Autofill saved data (if any) ----------
  const savedData = localStorage.getItem('intendedLearnersData');
  if (savedData) {
    try {
      const { objectives, intendedLearners, prerequisites } = JSON.parse(savedData);

      // Fill objectives
      const container = document.getElementById('objectives-container');
      container.innerHTML = '';
      objectives.forEach(obj => {
        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'form-input';
        input.value = obj;
        container.appendChild(input);
      });

      // Fill textareas
      const textareas = document.querySelectorAll('.form-textarea');
      if (textareas[0]) textareas[0].value = intendedLearners || '';
      if (textareas[1]) textareas[1].value = prerequisites || '';
    } catch (err) {
      console.error('Error loading saved data:', err);
    }
  }

});
