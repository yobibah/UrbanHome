<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php require_once VIEW_PATH . 'client/layout/header.php'; ?>

<main>
    <div class="bg-indigo-600 text-white py-12 text-center">
        <h1 class="text-3xl font-bold">Mon profil client</h1>
        <p class="text-lg mt-2">Retrouvez ici toutes vos informations personnelles et vos préférences.</p>
    </div>

    <section class="px-4 py-10">
        <h2 class="text-2xl font-bold text-indigo-600 text-center mb-8">Informations personnelles</h2>

        <?php foreach ($client as $bails): ?>
            <div class="flex items-center justify-center mb-10">
                <div class="bg-white shadow-lg rounded-2xl overflow-hidden w-full max-w-4xl">
                    <div class="flex flex-col md:flex-row">
                        <!-- Titre à gauche -->
                        <div class="w-full md:w-1/3 bg-indigo-500 text-white flex items-center justify-center p-6">
                            <p class="text-xl md:text-2xl font-semibold text-center">Mes Informations</p>
                        </div>

                        <!-- Infos personnelles -->
                        <div class="w-full md:w-2/3 p-6">
                            <h2 class="text-xl md:text-2xl font-bold text-indigo-600 mb-4 text-center md:text-left">
                                <?= htmlspecialchars($bails['objet']->getNom()) ?> <?= htmlspecialchars($bails['objet']->getPrenom()) ?>
                            </h2>

                            <p class="text-gray-700 mb-2"><strong>Email :</strong> <?= htmlspecialchars($bails['objet']->getEmail()) ?></p>
                            <p class="text-gray-700 mb-4"><strong>Téléphone :</strong> <?= htmlspecialchars($bails['objet']->getNumero_telephone()) ?></p>

                            <!-- Bouton Modifier -->
                            <div class="mt-6 text-center md:text-left">
                                <a href="/modifier?id=<?= base64_encode($bails['id']) ?>"
                                   class="inline-block bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 transition">
                                    ✏️ Modifier mon profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>

</body>
</html>
