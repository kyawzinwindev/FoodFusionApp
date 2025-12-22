document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('adminBurger');
    const sidebar = document.getElementById('adminSidebar');
    
    const closeBtn = document.getElementById('sidebarClose');
    
    // Only attach listener if elements exist
    if (burger && sidebar) {
        burger.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    if (closeBtn && sidebar) {
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    }
});
