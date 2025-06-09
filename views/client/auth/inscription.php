<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<script src="https://cdn.tailwindcss.com"></script>

<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4 pt-24 pb-24">
    <div class="bg-white shadow-lg rounded-2xl px-8 pt-10 pb-8 w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-blue-700 text-center mb-8">Inscription Client</h2>

        <form method="POST" action="Mon-inscription" class="grid grid-cols-1 md:grid-cols-2 gap-4" onsubmit="return validateForm()">
            <div>
                <label for="nom" class="block text-gray-700 font-medium text-sm">Nom</label>
                <input type="text" name="nom" id="nom" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="prenom" class="block text-gray-700 font-medium text-sm">Prénom</label>
                <input type="text" name="prenom" id="prenom" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="md:col-span-2">
                <label for="adresse" class="block text-gray-700 font-medium text-sm">Adresse</label>
                <input type="text" name="adresse" id="adresse" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium text-sm">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="telephone" class="block text-gray-700 font-medium text-sm">Téléphone</label>
                <input type="tel" name="telephone" id="telephone" pattern="^\+?\d{8,15}$" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="+226xxxxxxxx">
            </div>

            <div>
                <label for="mot_de_passe" class="block text-gray-700 font-medium text-sm">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" minlength="6" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="mot_de_passe2" class="block text-gray-700 font-medium text-sm">Confirmer mot de passe</label>
                <input type="password" name="mot_de_passe2" id="mot_de_passe2" minlength="6" required
                    class="w-full mt-1 p-2.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="md:col-span-2">
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3 rounded-lg transition duration-200">
                    S'inscrire
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">Déjà un compte ?
                <a href="/client" class="text-blue-600 hover:underline font-medium">Se connecter</a>
            </p>
        </div>
    </div>

    <script>
        function validateForm() {
            const tel = document.getElementById('telephone').value;
            const telRegex = /^\+?\d{8,15}$/;
            if (!telRegex.test(tel)) {
                alert("Veuillez entrer un numéro de téléphone valide (8 à 15 chiffres, avec ou sans '+').");
                return false;
            }
            return true;
        }
    </script>
</div>

<?php require_once VIEW_PATH . 'public/layout/footer.php'; ?>