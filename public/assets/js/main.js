// Permettre l'actualisation automatique de toutes les pages (auto-refresh)
// Actualise la page toutes les 5 minutes (300 000 ms)
setInterval(function() {
    window.location.reload();
}, 300000);

// Fonction utilitaire pour limiter la fréquence d'exécution d'une fonction (debounce)
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// Fonction pour basculer l'affichage du menu en fonction de la largeur de l'écran
function toggleMenu() {
    const menu = document.querySelector('.nav');
    const burger = document.querySelector('.burger');

    if (menu && burger) {
        if (window.innerWidth <= 900) {
            menu.classList.remove('active'); // Cacher le menu de navigation
            burger.style.display = 'flex'; // Afficher l'icône burger
        } else {
            menu.classList.add('active'); // Afficher le menu de navigation
            burger.style.display = 'none'; // Cacher l'icône burger
        }
    }
}

// Gestion du clic sur le menu burger
function handleBurgerClick() {
    const menu = document.querySelector('.nav');
    const burger = document.querySelector('.burger');

    if (menu && burger) {
        burger.classList.toggle('active'); // Basculer l'état actif de l'icône burger
        menu.classList.toggle('active'); // Basculer l'état actif du menu
    }
}

// Ajouter les événements resize et load pour appeler toggleMenu avec debounce
const optimizedToggleMenu = debounce(toggleMenu, 100);
['resize', 'load'].forEach(function(event) {
    window.addEventListener(event, optimizedToggleMenu);
});

// Ajouter un événement clic sur le menu burger
const burger = document.querySelector('.burger');
if (burger) {
    burger.addEventListener('click', handleBurgerClick);
}