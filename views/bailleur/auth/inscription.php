
<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>

<script src="https://cdn.tailwindcss.com"></script>


<div class="bg-gray-100 min-h-screen flex items-center justify-center p-4 pt-23">

    <?php if (!empty($_SESSION['msg'])) : ?>
        <div id="flashMessage" class="fixed top-4 right-4 bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out">
            <?= htmlspecialchars($_SESSION['msg']) ?>
        </div>
        <script>
            setTimeout(function () {
                const msg = document.getElementById('flashMessage');
                if (msg) msg.style.display = 'none';
            }, 5000);
        </script>

        <style>
            @keyframes fadeInOut {
                0% {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                10% {
                    opacity: 1;
                    transform: translateY(0);
                }
                90% {
                    opacity: 1;
                    transform: translateY(0);
                }
                100% {
                    opacity: 0;
                    transform: translateY(-10px);
                }
            }

            .animate-fade-in-out {
                animation: fadeInOut 5s ease-in-out forwards;
            }
        </style>

        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>

    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl px-8 pt-10 pb-8">
        <h2 class="text-2xl font-bold text-blue-600 mb-6 text-center">Inscription Bailleur</h2>

        <form method="POST" action="/register" class="space-y-4 text-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                    <input type="text" name="nom" id="nom" required
                        class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required
                        class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div>
                <label for="raison_social" class="block text-gray-700 font-medium">Raison sociale</label>
                <input type="text" name="raison_social" id="raison_social"
                    class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="adresse" class="block text-gray-700 font-medium">Adresse</label>
                <input type="text" name="adresse" id="adresse"
                    class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="telephone" class="block text-gray-700 font-medium">Téléphone</label>
                <input type="text" name="telephone" id="telephone" required
                    class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="mot_de_passe" class="block text-gray-700 font-medium">Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe" required
                        class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label for="confirm_mot_de_passe" class="block text-gray-700 font-medium">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_mot_de_passe" id="confirm_mot_de_passe" required
                        class="w-full mt-1 p-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                S'inscrire
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Vous avez déjà un compte ?
<<<<<<< HEAD
            <a href="/bailleur" class="text-blue-600 hover:underline font-medium">Se connecter</a>
=======
            <a href="/bailleur" class="text-green-600 hover:underline">Se connecter</a>
>>>>>>> b7b303adf4a1e36aab518f34d312ece15044b7e3
        </p>
    </div>
</div>
</div>
<?php require_once VIEW_PATH . 'public/layout/footer.php'; ?>