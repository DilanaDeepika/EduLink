document.addEventListener('DOMContentLoaded', () => {

    // --------------------------
    // Utility: show view
    // --------------------------
    function show(sectionId) {
        // Hide all views
        document.querySelectorAll('.view').forEach(v => v.hidden = true);

        // Show target view
        const target = document.getElementById(sectionId);
        if (target) target.hidden = false;

        // Update sidebar active/completed
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.classList.remove('active');
        });
        const clicked = [...document.querySelectorAll('.sidebar-item')]
            .find(i => i.dataset.target === sectionId);
        if (clicked) clicked.classList.add('active');
    }

    // --------------------------
    // Sidebar navigation clicks
    // --------------------------
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('click', () => {
            show(item.dataset.target);
        });
    });

    // --------------------------
    // Save and Next for Basic Info
    // --------------------------
    function saveBasicInfo() {
        const data = {
            className: document.getElementById('class-name')?.value || '',
            subject: document.getElementById('subject')?.value || '',
            gradeLevel: document.getElementById('grade-level')?.value || '',
            duration: document.getElementById('duration')?.value || '',
            subjectName: document.getElementById('subject-name')?.value || '',
            classCategory: document.getElementById('class-category')?.value || '',
            description: document.getElementById('course-description')?.value || '',
            language: document.getElementById('course-language')?.value || ''
        };
        localStorage.setItem('basicInfoData', JSON.stringify(data));
        alert('✅ Basic Information saved!');
    }

    document.getElementById('btn-saveChanges_basic')?.addEventListener('click', saveBasicInfo);

    document.getElementById('btn-next-basic')?.addEventListener('click', () => {
        saveBasicInfo();          // save before moving
        show('view-advance');     // go to Advanced Information
    });

    // --------------------------
    // Save and Next for Advanced Info
    // --------------------------
    function saveAdvancedInfo() {
        const data = {
            advancedTitle: document.getElementById('advanced-title')?.value || '',
            advancedDescription: document.getElementById('advanced-description')?.value || ''
            // add more fields from Advanced form if needed
        };
        localStorage.setItem('advancedInfoData', JSON.stringify(data));
        alert('✅ Advanced Information saved!');
    }

    document.getElementById('btn-saveChanges_advance')?.addEventListener('click', saveAdvancedInfo);

    document.getElementById('btn-next-advance')?.addEventListener('click', () => {
        saveAdvancedInfo();
        // For example, go to next step if you have more
        // show('view-intended');
    });

    // --------------------------
    // Autofill saved data on load
    // --------------------------
    const savedBasic = localStorage.getItem('basicInfoData');
    if (savedBasic) {
        const d = JSON.parse(savedBasic);
        document.getElementById('class-name')?.value = d.className || '';
        document.getElementById('subject')?.value = d.subject || '';
        document.getElementById('grade-level')?.value = d.gradeLevel || '';
        document.getElementById('duration')?.value = d.duration || '';
        document.getElementById('subject-name')?.value = d.subjectName || '';
        document.getElementById('class-category')?.value = d.classCategory || '';
        document.getElementById('course-description')?.value = d.description || '';
        document.getElementById('course-language')?.value = d.language || '';
    }

    const savedAdvanced = localStorage.getItem('advancedInfoData');
    if (savedAdvanced) {
        const d = JSON.parse(savedAdvanced);
        document.getElementById('advanced-title')?.value = d.advancedTitle || '';
        document.getElementById('advanced-description')?.value = d.advancedDescription || '';
    }

    // --------------------------
    // Show first view on load
    // --------------------------
    show('view-intended'); // default starting view
});
