// Actualisation automatique toutes les 5 minutes
setInterval(() => window.location.reload(), 300000);

// Menu burger responsive (compatible avec le code navbar amélioré)
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('burger');
    const nav = document.getElementById('nav');
    if (!menuToggle || !nav) return;

    function checkMenu() {
        if(window.innerWidth <= 900) {
            menuToggle.style.display = 'block';
            nav.style.display = 'none';
        } else {
            menuToggle.style.display = 'none';
            nav.style.display = 'flex';
        }
    }
    checkMenu();
    window.addEventListener('resize', checkMenu);
    menuToggle.addEventListener('click', function() {
        nav.style.display = (nav.style.display === 'flex') ? 'none' : 'flex';
    });
});
