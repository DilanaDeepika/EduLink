const navItems = document.querySelectorAll('.sidebar-item');
const views = document.querySelectorAll('.view');
const progressFill = document.querySelector('.progress-fill');
const progressPercentage = document.querySelector('.progress-percentage');

function updateProgress() {
    const completed = document.querySelectorAll('.sidebar-item.completed').length;
    const total = navItems.length;
    const percentage = Math.round((completed / total) * 100);
            
    progressFill.style.width = percentage + '%';
    progressPercentage.textContent = percentage + '%';
}

function show(targetId) {
    // Hide all views
    views.forEach(v => v.hidden = true);

    // Show selected view
    const target = document.getElementById(targetId);
    if (target) target.hidden = false;

    // Update active class
    navItems.forEach(item => item.classList.remove('active'));
function updateProgress() {
    const completed = document.querySelectorAll('.sidebar-item.completed').length;
    const total = navItems.length;
    const percentage = Math.round((completed / total) * 100);
            
    progressFill.style.width = percentage + '%';
    progressPercentage.textContent = percentage + '%';
}

function show(targetId) {
    // Hide all views
    views.forEach(v => v.hidden = true);

    // Show selected view
    const target = document.getElementById(targetId);
    if (target) target.hidden = false;

    // Update active class
    navItems.forEach(item => item.classList.remove('active'));
    const clicked = [...navItems].find(i => i.dataset.target === targetId);
    if (clicked) {
        clicked.classList.add('active');
        clicked.classList.add('completed');
        updateProgress();
    }
}

navItems.forEach(item => {
    item.addEventListener('click', () => show(item.dataset.target));
});

// Show the first section on load
if (navItems.length) {
    show(navItems[0].dataset.target);
}clicked = [...navItems].find(i => i.dataset.target === targetId);
    if (clicked) {
        clicked.classList.add('active');
        clicked.classList.add('completed');
        updateProgress();
    }
}

navItems.forEach(item => {
    item.addEventListener('click', () => show(item.dataset.target));
});

// Show the first section on load
if (navItems.length) {
    show(navItems[0].dataset.target);
}