<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Bailleur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<<<<<<< HEAD

<?php require_once VIEW_PATH . '/bailleur/layout/header.php'; ?>
=======
<?php require_once VIEW_PATH . 'bailleur/layout/header.php'; ?>

>>>>>>> b7b303adf4a1e36aab518f34d312ece15044b7e3
<body class="bg-gray-100 font-sans">


    <?php if (isset($_SESSION['id'])) : ?>
        <!-- Contenu principal -->
        <main class="flex-1 p-8">
            <header class="mb-6">
                <h1 class="text-3xl font-semibold text-white-800">Bienvenue, <?= $_SESSION['nom'] ?? 'Bailleur' ?> 👋</h1>
                <p class="text-gray-100">Voici votre tableau de bord.</p>
            </header>
            <?php if (isset($_SESSION['success_maj']) ) : ?>
            <div id="flashMessage" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out">
        <?= htmlspecialchars($_SESSION['success_maj']) ?>
    </div>
    <script>
        setTimeout(function () {
            const msg = document.getElementById('flashMessage');
            if (msg) msg.style.display = 'none';
        }, 5000);
    </script>
    <style>
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-10px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }
        .animate-fade-in-out {
            animation: fadeInOut 5s ease-in-out forwards;
        }
    </style>
    <?php unset($_SESSION['success_maj']); ?>
<?php endif; ?>


            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Nombres proprietes</h3>
                   <p class="text-3xl font-semibold text-blue-600"><?=  $nbreProprietes?></p>

                </div>
            

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Rendez-Vous</h3>
                    <p class="text-3xl font-semibold text-green-600"><?=isset($_SESSION['rdv']) ? $_SESSION['rdv'] : 0 ?></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-gray-700 text-lg font-bold mb-2">Ventes-Locations</h3>
                    <p class="text-3xl font-semibold text-indigo-600"><?= isset($nb_ventes) ? $nb_ventes : 0 ?></p>
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

<<<<<<< HEAD
                    <a href="Demande-Visite<?= $encodedId?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Voir les demandes</a>
                    <a href="Mon-profil?id=<?= $encodedId?>" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Mon profil</a>
=======
                    <a href="/bailleur/rdv?id=<?= $encodedId ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Voir les demandes</a>
                    <a href="/bailleur/profile?id=<?= $encodedId ?>" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Mon profil</a>
>>>>>>> b7b303adf4a1e36aab518f34d312ece15044b7e3
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