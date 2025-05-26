<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>

<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Titre principal -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-800">Bienvenue sur notre site de gestion immobilière</h1>
            <p class="text-lg text-gray-600 mt-4">Découvrez nos propriétés à louer ou à vendre.</p>
        </div>

        <!-- Grille de cartes -->
        <?php foreach ($bannieres as $banniere): ?>
            <section class="bg-[url('assets/images/ <?= $banniere['im'] ?> ')] bg-cover bg-center py-16">
            <?php endforeach; ?>
            <div class="bg-white/80 backdrop-blur-sm px-4 sm:px-8 lg:px-16 py-10 rounded-xl max-w-7xl mx-auto">

                <!-- Description du site -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-indigo-700 mb-4">Bienvenue sur notre plateforme immobilière</h2>
                    <p class="text-gray-700 text-lg">
                        Découvrez une sélection exclusive de biens immobiliers disponibles à la location et à la vente. Que vous cherchiez un appartement, une maison ou un local commercial, nous avons ce qu’il vous faut.
                    </p>
                </div>

                <!-- Grille des propriétés -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($proprietes as $propriete): ?>
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                            <!-- Image de la propriété -->
                            <img src="<?= ASSET_PATH ?>images/<?= $propriete['objet']->getImage1() ?>" alt="Propriété" class="w-full h-56 object-cover">

                            <!-- Détails de la propriété -->
                            <div class="p-6">
                                <h5 class="text-2xl font-semibold text-indigo-600 mb-2">
                                    <?= number_format($propriete['objet']->getPrix(), 0, ',', ' ') ?> FCFA
                                </h5>
                                <p class="text-gray-700 text-sm mb-2"><?= substr($propriete['objet']->getDescription(), 0, 100) ?>...</p>
                                <p class="text-gray-500 text-sm mb-1">Mise en : <span class="font-medium"><?= $propriete['objet']->getOpt() ?></span></p>
                                <p class="text-gray-500 text-sm mb-4">Type : <span class="font-medium"><?= $propriete['type']->getlibele() ?></span></p>

                                <!-- Bouton -->
                                <a href="/propriete/detail?id=<?= base64_encode($propriete['id']) ?>" class="inline-block bg-indigo-500 text-white px-5 py-2 rounded-lg hover:bg-indigo-600 text-sm font-medium transition">
                                    Voir plus
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
            </section>
    </div>


 <?php require_once VIEW_PATH . 'public/layout/footer.php'; ?>