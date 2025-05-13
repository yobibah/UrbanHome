<?php
// Vue d'accueil pour l'espace client
require_once __DIR__ . '/../layout/header.php';
?>

<main>
    <div class="home-banner">
        <h1>Bienvenue sur votre espace client UrbanHome</h1>
        <p>Consultez vos locations, gérez vos informations et découvrez nos nouveautés !</p>
    </div>
    <div class="home-sections">
        <div class="home-section">
            <h2>Mes locations</h2>
            <p>Visualisez et gérez vos biens loués en toute simplicité.</p>
        </div>
        <div class="home-section">
            <h2>Profil</h2>
            <p>Modifiez vos informations personnelles et vos préférences.</p>
        </div>
        <div class="home-section">
            <h2>Support</h2>
            <p>Contactez notre équipe pour toute question ou assistance.</p>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>