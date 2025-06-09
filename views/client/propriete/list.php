<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<?php require_once VIEW_PATH . 'client/layout/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>


<div class =>
<section class="mt-20 px-6">
    <!-- Grille des propriétés -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($proprietes as $propriete): ?>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <!-- Image de la propriété -->
                <img src="assets/images/<?= $propriete['objet']->getImage1() ?>" alt="Propriété" class="w-full h-56 object-cover">
                <!-- Détails de la propriété -->
                <div class="p-6">
                    <h5 class="text-2xl font-semibold text-indigo-600 mb-2">
                        <?= number_format($propriete['objet']->getPrix(), 0, ',', ' ') ?> FCFA
                    </h5>
                    <p class="text-gray-700 text-sm mb-2"><?= substr($propriete['objet']->getDescription(), 0, 100) ?>...</p>
                    <p class="text-gray-500 text-sm mb-1">Mise en : <span class="font-medium"><?= $propriete['objet']->getOpt() ?></span></p>
                    <p class="text-gray-500 text-sm mb-4">Type : <span class="font-medium"><?= $propriete['type']->getlibele() ?></span></p>
                    <p class="text-gray-500 text-sm mb-4">Etat : <span class="font-medium"><?= $propriete['objet']->getEtat() ?></span></p>
                    <!-- Bouton -->
                    <a href="/detail?id=<?= base64_encode($propriete['id']) ?>" class="inline-block bg-indigo-500 text-white px-5 py-2 rounded-lg hover:bg-indigo-600 text-sm font-medium transition">
                        Voir plus
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

</div>
<?php
    // Variables par défaut si elles ne sont pas déjà définies
    $page = $page ?? 1;
    $total_pages = $total_pages ?? 1;
?>

<div class="flex justify-center my-10">
    <nav class="inline-flex shadow-sm rounded-md" aria-label="Pagination">
        <!-- Page précédente -->
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100">
                Précédent
            </a>
        <?php else: ?>
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">
                Précédent
            </span>
        <?php endif; ?>

        <!-- Pages numérotées -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>"
               class="relative inline-flex items-center px-4 py-2 border text-sm font-medium <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <!-- Page suivante -->
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100">
                Suivant
            </a>
        <?php else: ?>
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-r-md cursor-not-allowed">
                Suivant
            </span>
        <?php endif; ?>
    </nav>
</div>




<?php require_once VIEW_PATH . 'public/layout/footer.php'; ?>