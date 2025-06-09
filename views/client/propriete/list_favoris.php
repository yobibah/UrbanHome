<?php require_once VIEW_PATH . 'client/layout/header.php'; ?>

<div>
    <a href="/client" class="text-blue-600 hover:underline ml-4 mt-4 inline-block">← Retour</a>
</div>

<div class="container mx-auto px-4 py-8 flex flex-col min-h-screen">

    <h1 class="text-3xl font-bold mb-8">Mes favoris</h1>

    <?php if (!empty($msg)): ?>
        <div class="bg-yellow-100 text-yellow-800 px-6 py-4 rounded-lg shadow mb-6">
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($favoris)): ?>
        <ul class="space-y-4">
            <?php foreach ($favoris as $fav): ?>
                <li class="flex items-center bg-white shadow rounded-lg overflow-hidden p-4">
                    <img src="/assets/images/<?= htmlspecialchars($fav['image1']) ?>"
                        alt="Image"
                        class="w-20 h-20 object-cover rounded mr-4 border">

                    <div class="flex-1">
                        <p class="text-gray-700 font-semibold"><?= htmlspecialchars($fav['libelle']) ?></p>
                        <p class="text-sm text-gray-500"><?= number_format($fav['prix'], 0, ',', ' ') ?> FCFA</p>
                        <div class="mt-2 space-x-4">
                            <a href="/Espace-client/proprietes/detail?id=<?= base64_encode($fav['id_propiete']) ?>" class="text-blue-600 hover:underline text-sm">
                                Voir la propriété
                            </a>
                            <a href="/supprimer-favoris?id=<?=base64_encode($fav['id_favoris']) ?>" class="text-red-600 hover:underline text-sm">
                                Supprimer
                            </a>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="bg-white rounded-lg shadow-md p-6 text-center mt-12">
            <p class="text-gray-500">Vous n'avez pas encore de propriétés favorites.</p>
        </div>
    <?php endif; ?>

    <!-- Pagination fixe en bas -->
    <?php if ($totalPages > 1): ?>
        <div class="w-full mt-auto px-4 py-6 bg-white">
            <div class="flex justify-center">
                <nav class="inline-flex shadow-sm rounded-md" aria-label="Pagination">
                    <!-- Page précédente -->
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?= $currentPage - 1 ?>"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-100">
                            Précédent
                        </a>
                    <?php else: ?>
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-l-md cursor-not-allowed">
                            Précédent
                        </span>
                    <?php endif; ?>

                    <!-- Pages numérotées -->
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium
                           <?= $i == $currentPage ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Page suivante -->
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-100">
                            Suivant
                        </a>
                    <?php else: ?>
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-r-md cursor-not-allowed">
                            Suivant
                        </span>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    <?php endif; ?>

</div>
</div>

<?php require_once VIEW_PATH . 'client/layout/footer.php'; ?>