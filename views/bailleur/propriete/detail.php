
<?php require_once VIEW_PATH . '/bailleur/layout/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-7xl mx-auto px-4 pt-12">
    <?php foreach ($proprietes as $propriete): ?>
        <div class="grid md:grid-cols-2 gap-6 mb-10 bg-white shadow-md rounded-lg p-6">
            <!-- Galerie d'images -->
            <div class="grid grid-cols-3 gap-4">
                <!-- Image principale (grande à gauche) -->
                <div class="col-span-2">
                    <img src="assets/images/<?= $propriete['objet']->getImage1() ?>" alt="Image 1"
                        class="w-full h-96 object-cover rounded-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                </div>
                <!-- Deux petites images empilées à droite -->
                <div class="flex flex-col gap-4">
                    <img src="assets/images/<?= $propriete['objet']->getImage2() ?>" alt="Image 2"
                        class="w-full h-44 object-cover rounded-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                    <img src="assets/images/<?= $propriete['objet']->getImage3() ?>" alt="Image 3"
                        class="w-full h-44 object-cover rounded-lg transition duration-300 transform hover:scale-105 hover:shadow-xl">
                </div>
            </div>

            <!-- Détails de la propriété -->
            <div class="flex flex-col justify-between">
                <div class="space-y-3 text-gray-700">
                    <p><?= $propriete['objet']->getDescription() ?></p>
                    <?php if ($propriete['objet']->getOpt() == "Vente"): ?>
                        <p><strong>Prix :</strong> <?= number_format($propriete['objet']->getPrix(), 0, ',', ' ') ?> CFA</p>
                    <?php else: ?>
                        <p><strong>Montant Mensuel:</strong> <?= number_format($propriete['objet']->getPrix(), 0, ',', ' ') ?> CFA</p>
                    <?php endif; ?>
                    <p><strong>Adresse :</strong> <?= $propriete['objet']->getAdresse() ?></p>
                    <p><strong>Type :</strong> <?= $propriete['type']->getlibele() ?></p>
                    <p><strong>Statut :</strong> <?= $propriete['objet']->getEtat() ?></p>
                    <p><strong>Option :</strong> <?= $propriete['objet']->getOpt() ?></p>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="/modifier-propriete?id=<?= base64_encode($propriete['id']) ?>"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Modifier</a>
                    <a href="/supprimer-propriete?id=<?= base64_encode($propriete['id']) ?>"
                        class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">Supprimer</a>
                    <a href="/mes-proprietes"
                        class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">Retour</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
