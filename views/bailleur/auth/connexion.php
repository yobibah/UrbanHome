
<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>

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
            0% { opacity: 0; transform: translateY(-10px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }
        .animate-fade-in-out {
            animation: fadeInOut 5s ease-in-out forwards;
        }
    </style>
    <?php unset($_SESSION['msg']); ?>
<?php endif; ?>

<!-- Conteneur centré -->
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">
    <div class="w-full max-w-xl bg-white shadow-lg rounded-2xl px-8 pt-10 pb-8">
        <h2 class="text-2xl font-bold text-blue-600 text-center mb-8">Connexion Bailleur</h2>

        <form method="POST" action="/home-bailleur" class="space-y-5">
            <div>
                <label for="email" class="block text-gray-700 font-medium text-sm">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="mot_de_passe" class="block text-gray-700 font-medium text-sm">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 rounded-lg transition duration-200">
                Se connecter
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Vous n'avez pas de compte ? 
            <a href="/Inscription" class="text-blue-600 hover:underline font-medium">S'inscrire</a>
        </p>
    </div>
</div>

<?php require_once VIEW_PATH . 'public/layout/footer.php'; ?>
