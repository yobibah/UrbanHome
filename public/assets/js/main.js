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
