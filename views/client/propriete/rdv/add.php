<script src="https://cdn.tailwindcss.com"></script>

<?php require_once VIEW_PATH . 'client/layout/header.php'; ?>
<div class="fixed top-5 right-5 z-50">
    <?php if (isset($_SESSION['msg'])): ?>
        <div id="flash-message" class="bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg animate-slide-in">
            <?= $_SESSION['msg'] ?>
            <?php unset($_SESSION['msg']); ?>
        </div>

        <script>
            // Disparition automatique avec animation
            setTimeout(() => {
                const msg = document.getElementById('flash-message');
                if (msg) {
                    msg.classList.add('animate-slide-out');
                    setTimeout(() => msg.remove(), 500); // Supprime après animation
                }
            }, 3000); // Affiché 3 secondes
        </script>

        <style>
            @keyframes slide-in {
                from {
                    opacity: 0;
                    transform: translateX(100%);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slide-out {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }

            .animate-slide-in {
                animation: slide-in 0.4s ease-out forwards;
            }

            .animate-slide-out {
                animation: slide-out 0.4s ease-in forwards;
            }
        </style>
    <?php endif; ?>
</div>

<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Ajouter un rendez-vous</h2>

    <?php foreach ($proprietes as $propriete): ?>
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <p class="text-gray-700 mb-4"><?= $propriete['objet']->getDescription() ?></p>
            <p class="text-gray-500 mb-2">
                Mise en : <span class="font-medium"><?= $propriete['objet']->getOpt() ?></span>
            </p>

            <div class="images">
                <img src="/assets/images/<?= $propriete['objet']->getImage1() ?>"
                     alt="Image de la propriété"
                     class="w-32 h-32 object-cover rounded-md">
            </div>

            <p class="text-gray-500">
                Prix : <?= number_format($propriete['objet']->getPrix(), 0, ',', ' ') ?> FCFA
            </p>
            <p class="text-gray-500">
                Type : <?= $propriete['type']->getlibele() ?>
            </p>
        </div>
    <?php endforeach; ?>

    <!-- Formulaire placé en bas du conteneur -->
    <form action="/Espace-client/proprietes/rdv/add" method="POST"
          class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">
                Date du rendez-vous
            </label>
            <input type="date" id="date" name="date" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                          focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="mb-4">
            <label for="heure" class="block text-sm font-medium text-gray-700">
                Heure du rendez-vous
            </label>
            <input type="time" id="heure" name="heure" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                          focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="mb-4">
            <label for="propriete_id" class="block text-sm font-medium text-gray-700">
                Propriété
            </label>
            <select id="propriete_id" name="propriete_id" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                           focus:ring-indigo-500 focus:border-indigo-500">
                <?php foreach ($proprietes as $propriete): ?>
                    <option value="<?= $propriete['id'] ?>">
                        <?= $propriete['type']->getlibele() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">
                Description
            </label>
            <textarea id="description" name="descriptions" rows="4"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                             focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <button type="submit"
                class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md
                       hover:bg-indigo-700 transition duration-200">
            Ajouter le rendez-vous
        </button>
    </form>
</div>
