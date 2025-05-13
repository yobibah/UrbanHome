<?php
// Vue d'accueil pour l'espace manager
require_once __DIR__ . '/../layout/header.php';
?>

<main>
    <div class="home-banner">
        <h1>Bienvenue sur votre espace manager UrbanHome</h1>
        <p>Gérez les utilisateurs, les propriétés et suivez l’activité de la plateforme.</p>
    </div>
    <div class="home-sections">
        <div class="home-section">
            <h2>Gestion des clients</h2>
            <p>Consultez, assignez et gérez les comptes clients.</p>
        </div>
        <div class="home-section">
            <h2>Propriétés</h2>
            <p>Supervisez l’ensemble des biens immobiliers de la plateforme.</p>
        </div>
        <div class="home-section">
            <h2>Contrats & paiements</h2>
            <p>Suivez les contrats, paiements et statistiques globales.</p>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
