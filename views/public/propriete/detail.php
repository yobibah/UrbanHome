<?php
require_once VIEW_PATH.'public/layout/header.php';
?>

<main>
    <section class="home-section">
        <h1>Détail de la propriété</h1>
        <!-- Exemple de détails, à remplacer par des données dynamiques -->
        <ul>
            <li><strong>Nom :</strong> Appartement T2</li>
            <li><strong>Ville :</strong> Paris</li>
            <li><strong>Type :</strong> Appartement</li>
            <li><strong>Prix :</strong> 1200 €</li>
            <li><strong>Description :</strong> Bel appartement lumineux, proche du centre-ville.</li>
        </ul>
        <a href="/views/public/list" class="btn">Retour à la liste</a>
    </section>
</main>

<?php require_once VIEW_PATH.'public/layout/footer.php'; ?>
