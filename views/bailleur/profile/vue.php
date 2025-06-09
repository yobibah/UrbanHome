<script src="https://cdn.tailwindcss.com"></script>

<?php require_once VIEW_PATH . '/bailleur/layout/header.php'; ?>


<?php foreach ($bail as $bails): ?>

   <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-10">

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden w-full max-w-4xl">
            <div class="flex flex-col md:flex-row">
                <!-- Titre à gauche -->
                <div class="w-full md:w-1/3 bg-indigo-500 text-white flex items-center justify-center p-6">
                    <p class="text-2xl font-semibold text-center">Mes Informations</p>
                </div>

                <!-- Infos personnelles -->
                <div class="w-full md:w-2/3 p-6">
                    <h2 class="text-2xl font-bold text-indigo-600 mb-4 text-center md:text-left">
                        <?= htmlspecialchars($bails['objet']->getNom()) ?> <?= htmlspecialchars($bails['objet']->getPrenom()) ?>
                    </h2>

                    <p class="text-gray-700 mb-2"><strong>Email :</strong> <?= htmlspecialchars($bails['objet']->getEmail()) ?></p>
                    <p class="text-gray-700 mb-2"><strong>Téléphone :</strong> <?= htmlspecialchars($bails['objet']->getTelephone()) ?></p>
                    <p class="text-gray-700 mb-2"><strong>Adresse :</strong> <?= htmlspecialchars($bails['objet']->getAdresse()) ?></p>
                    <p class="text-gray-700 mb-4"><strong>Raison Sociale :</strong> <?= htmlspecialchars($bails['objet']->getRaisonSocial()) ?></p>

                    <!-- Bouton Modifier -->
                    <div class="mt-6 text-center md:text-left">
                        <a href="/modifer?id=<?= base64_encode($bails['id']) ?>"
                            class="inline-block bg-indigo-500 text-white px-6 py-2 rounded-lg hover:bg-indigo-600 transition">
                            ✏️ Modifier mon profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>