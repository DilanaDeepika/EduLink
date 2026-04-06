document.addEventListener('DOMContentLoaded', () => {

    // --------------------------
    // Elements
    // --------------------------
    const navItems = document.querySelectorAll('.sidebar-item');
    const views = document.querySelectorAll('.view');
    const progressFill = document.querySelector('.progress-fill');
    const progressPercentage = document.querySelector('.progress-percentage');

    // --------------------------
    // Progress update
    // --------------------------
    function updateProgress() {
        if (!progressFill || !progressPercentage) return;
        const completed = document.querySelectorAll('.sidebar-item.completed').length;
        const total = navItems.length;
        const percentage = Math.round((completed / total) * 100);
        progressFill.style.width = percentage + '%';
        progressPercentage.textContent = percentage + '%';
    }

    // --------------------------
    // Show a section
    // --------------------------
    function show(sectionId) {
        views.forEach(v => v.hidden = true); // hide all
        const target = document.getElementById(sectionId);
        if (target) target.hidden = false;

        navItems.forEach(item => item.classList.remove('active'));
        const clicked = Array.from(navItems).find(i => i.dataset.target === sectionId);
        if (clicked) clicked.classList.add('active');

        updateProgress();
    }

    // --------------------------
    // Sidebar click
    // --------------------------
    navItems.forEach(item => {
        item.addEventListener('click', () => show(item.dataset.target));
    });

    // --------------------------
    // Save Basic Info
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
        document.querySelector('.sidebar-item[data-target="view-core"]')?.classList.add('completed');
        updateProgress();
    }

    document.getElementById('btn-saveChanges_basic')?.addEventListener('click', saveBasicInfo);
    document.getElementById('btn-next-basic')?.addEventListener('click', () => {
        saveBasicInfo();
        show('view-advance');
        document.querySelector('.sidebar-item[data-target="view-core"]')?.classList.add('completed');
    });

    // --------------------------
    // Save Advanced Info
    // --------------------------
    function saveAdvancedInfo() {
        const data = {
            advancedTitle: document.getElementById('advanced-title')?.value || '',
            advancedDescription: document.getElementById('advanced-description')?.value || ''
            // Add more fields if needed
        };
        localStorage.setItem('advancedInfoData', JSON.stringify(data));
        alert('✅ Advanced Information saved!');
        document.querySelector('.sidebar-item[data-target="view-advance"]')?.classList.add('completed');
        updateProgress();
    }

    document.getElementById('btn-saveChanges_advance')?.addEventListener('click', saveAdvancedInfo);
    document.getElementById('btn-next-advance')?.addEventListener('click', () => {
        saveAdvancedInfo();
        // If you have more steps, go next
        // show('view-nextStep');
    });

    // --------------------------
    // Autofill data
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
        document.querySelector('.sidebar-item[data-target="view-core"]')?.classList.add('completed');
    }

    const savedAdvanced = localStorage.getItem('advancedInfoData');
    if (savedAdvanced) {
        const d = JSON.parse(savedAdvanced);
        document.getElementById('advanced-title')?.value = d.advancedTitle || '';
        document.getElementById('advanced-description')?.value = d.advancedDescription || '';
        document.querySelector('.sidebar-item[data-target="view-advance"]')?.classList.add('completed');
    }

    // --------------------------
    // Show first view on load
    // --------------------------
    show('view-intended'); // default starting view
});
