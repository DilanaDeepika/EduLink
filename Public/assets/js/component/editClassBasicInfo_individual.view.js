// editClassBasicInfo_individual.js

document.addEventListener('DOMContentLoaded', function() {

    // Handle Next button click
    const btnNextCore = document.getElementById('btn-next-core');
    if (btnNextCore) {
        btnNextCore.addEventListener('click', function(event) {
            event.preventDefault();
            // Replace with your actual navigation function
            show('view-advance'); // move to next section
        });
    }

    // Handle Save as Draft button
    const btnSave = document.getElementById('btn_save-basic');
    btnSave.addEventListener('click', function() {
        // Collect all form values
        const className = document.getElementById('class-name').value.trim();
        const subject = document.getElementById('subject').value;
        const gradeLevel = document.getElementById('grade-level').value;
        const duration = document.getElementById('duration').value;
        const subjectName = document.getElementById('subject-name').value.trim();
        const classCategory = document.getElementById('class-category').value;
        const courseDescription = document.getElementById('course-description').value.trim();
        const courseLanguage = document.getElementById('course-language').value;

        // Create an object with the collected data
        const basicInfoData = {
            className,
            subject,
            gradeLevel,
            duration,
            subjectName,
            classCategory,
            courseDescription,
            courseLanguage
        };

        // Mock save - Replace this with a real API call
        console.log("Saved Basic Info Data:", basicInfoData);
        alert("✅ Basic Information saved successfully (mock).");

        // Optionally, store in localStorage for persistence
        localStorage.setItem('basicInfoData', JSON.stringify(basicInfoData));
    });

    // Auto-fill form if data exists in localStorage
    const savedData = localStorage.getItem('basicInfoData');
    if (savedData) {
        const data = JSON.parse(savedData);
        if (data.className) document.getElementById('class-name').value = data.className;
        if (data.subject) document.getElementById('subject').value = data.subject;
        if (data.gradeLevel) document.getElementById('grade-level').value = data.gradeLevel;
        if (data.duration) document.getElementById('duration').value = data.duration;
        if (data.subjectName) document.getElementById('subject-name').value = data.subjectName;
        if (data.classCategory) document.getElementById('class-category').value = data.classCategory;
        if (data.courseDescription) document.getElementById('course-description').value = data.courseDescription;
        if (data.courseLanguage) document.getElementById('course-language').value = data.courseLanguage;
    }

});
