const sidebar = document.querySelector('.sidebar');
const toggleBtn = document.getElementById('sidebarToggle');
const navItems = document.querySelectorAll('.nav-item');

// Sidebar toggle
toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
});

// Highlight active page
navItems.forEach(item => {
    if (item.href === window.location.href) {
        item.classList.add('active');
    }
});