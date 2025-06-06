// Permettre l'actualisation automatique de toutes les pages (auto-refresh)
// Actualise la page toutes les 5 minutes (300 000 ms)
setInterval(function() {
    window.location.reload();
}, 300000);

// Menu burger responsive
window.addEventListener('DOMContentLoaded', function() {
    const burger = document.getElementById('burgerMenu');
    const nav = document.getElementById('mainNavbar');
    if (burger && nav) {
        burger.addEventListener('click', function() {
            nav.classList.toggle('active');
            burger.classList.toggle('open');
        });
    }
});

// Sidebar responsive pour l'espace bailleur
window.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');
    if (sidebar && toggle) {
        toggle.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
        });
    }
});

// Sidebar responsive pour l'espace client
window.addEventListener('DOMContentLoaded', function() {
    const sidebarClient = document.getElementById('sidebarClient');
    const toggleClient = document.getElementById('sidebarToggleClient');
    if (sidebarClient && toggleClient) {
        toggleClient.addEventListener('click', function() {
            sidebarClient.classList.toggle('hidden');
        });
    }
});

// Sidebar responsive pour l'espace manager
window.addEventListener('DOMContentLoaded', function() {
    const sidebarManager = document.getElementById('sidebarManager');
    const toggleManager = document.getElementById('sidebarToggleManager');
    if (sidebarManager && toggleManager) {
        toggleManager.addEventListener('click', function() {
            sidebarManager.classList.toggle('hidden');
        });
    }
});
