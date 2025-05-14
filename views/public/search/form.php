<?php
require_once VIEW_PATH.'public/layout/header.php';
?>

<main>
    <section class="home-section">
        <h1>Recherche de biens immobiliers</h1>
        <form action="result.php" method="get">
            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" placeholder="Ex : Ouaga">

            <label for="type">Type de bien :</label>
            <select id="type" name="type">
                <option value="">--Choisir--</option>
                <option value="appartement">Appartement</option>
                <option value="maison">Maison</option>
                <option value="studio">Studio</option>
            </select>

            <label for="budget">Budget max (€) :</label>
            <input type="number" id="budget" name="budget" min="0">

            <button type="submit" class="btn">Rechercher</button>
        </form>
    </section>
</main>

<?php require_once VIEW_PATH.'public/layout/footer.php'; ?>
