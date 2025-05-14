<?php
require_once VIEW_PATH.'layout/header.php';
?>

<main>
    <div class="home-banner">
        <h1>Mon profil client</h1>
        <p>Retrouvez ici toutes vos informations personnelles et vos préférences.</p>
    </div>
    <section class="home-section">
        <h2>Informations personnelles</h2>
        <ul>
            <li><strong>Nom :</strong> <!-- Afficher le nom du client ici --></li>
            <li><strong>Email :</strong> <!-- Afficher l'email du client ici --></li>
            <li><strong>Téléphone :</strong> <!-- Afficher le téléphone du client ici --></li>
            <!-- Ajouter d'autres infos si besoin -->
        </ul>
        <a href="edit.php" class="btn">Modifier mon profil</a>
    </section>
</main>

<?php require_once VIEW_PATH.'layout/footer.php'; ?>
