<?php
// Vue d'accueil pour l'espace bailleur
require_once __DIR__ . '/../layout/header.php';
?>

<main>
    <div class="home-banner">
        <h1>Bienvenue sur votre espace bailleur UrbanHome</h1>
        <p>Gérez vos propriétés, consultez vos contrats et suivez vos rendez-vous facilement !</p>
    </div>
    <div class="home-sections">
        <div class="home-section">
            <h2>Mes propriétés</h2>
            <p>Ajoutez, modifiez ou supprimez vos biens immobiliers.</p>
        </div>
        <div class="home-section">
            <h2>Contrats</h2>
            <p>Consultez et gérez les contrats de location en cours.</p>
        </div>
        <div class="home-section">
            <h2>Rendez-vous</h2>
            <p>Planifiez et suivez vos rendez-vous avec les clients.</p>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
