<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Bailleur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<?php require_once VIEW_PATH . 'bailleur/layout/header.php'; ?>

<body class="bg-gray-100 font-sans">


    <?php if (isset($_SESSION['id'])) : ?>
        <!-- Contenu principal -->
        <main class="flex-1 p-8">
            <header class="mb-6">
                <h1 class="text-3xl font-semibold text-gray-800">Bienvenue, <?= $_SESSION['nom'] ?? 'Bailleur' ?> 👋</h1>
                <p class="text-gray-500">Voici votre tableau de bord.</p>
            </header>

            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Nombres proprietes</h3>
                    <p class="text-3xl font-semibold text-blue-600">12</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Rendez-Vous</h3>
                    <p class="text-3xl font-semibold text-green-600">5</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Ventes-Locations</h3>
                    <p class="text-3xl font-semibold text-indigo-600">1 -- 2</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Montant total engagé</h3>
                    <p class="text-3xl font-semibold text-indigo-600">45M CFA</p>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white p-6 rounded-xl shadow-md action">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Actions rapides</h2>
                <div class="space-x-4">
                    <?php $encodedId = base64_encode($_SESSION['id']); ?>
                    <a href="/bailleur/propriete?id=<?= $encodedId ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"> Ajouter une propriete</a>

                    <a href="/bailleur/rdv?id=<?= $encodedId ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Voir les demandes</a>
                    <a href="/bailleur/profile?id=<?= $encodedId ?>" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Mon profil</a>
                </div>
            </div>
        </main>
        </div>

    <?php else : ?>
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-red-600">Erreur</h2>
                <p class="text-gray-700">Vous devez être connecté pour accéder à cette page.</p>
                <a href="/bailleur" class="text-blue-600 hover:underline">Se connecter</a>
            </div>
        </div>

    <?php endif; ?>


</body>

</html>
<?php require_once VIEW_PATH . 'bailleur/layout/footer.php'; ?>