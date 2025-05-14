<?php
require_once VIEW_PATH.'public/layout/header.php';
?>

<main>
    <section class="home-section">
        <h1>Liste des propriétés disponibles</h1>
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Type</th>
                    <th>Prix (€)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemple de ligne, à remplacer par une boucle PHP sur les propriétés -->
                <tr>
                    <td>Appartement T2</td>
                    <td>Paris</td>
                    <td>Appartement</td>
                    <td>1200</td>
                    <td><a href="/views/public/propriete/detail?id=1">Voir</a></td>
                </tr>
                <!-- ... -->
            </tbody>
        </table>
    </section>
</main>

<?php require_once VIEW_PATH.'public/layout/footer.php'; ?>
