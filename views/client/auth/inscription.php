<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Inscription Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-2xl px-8 pt-10 pb-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-blue-600 text-center mb-6">Inscription Client</h2>

        <form method="POST" action="Mon-inscription" class="space-y-4" onsubmit="return validateForm()">
            <div>
                <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                <input type="text" name="nom" id="nom" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                <input type="text" name="prenom" id="prenom" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
              <div>
                <label for="adresse" class="block text-gray-700 font-medium">Adresse</label>
                <input type="text" name="adresse" id="adresse" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

                <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="telephone" class="block text-gray-700 font-medium">Numéro de téléphone</label>
                <input type="tel" name="telephone" id="telephone" pattern="^\+?\d{8,15}$" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="+226xxxxxxxx">
            </div>

            <div>
                <label for="mot_de_passe" class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" minlength="6" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

                    <div>
                <label for="mot_de_passe" class="block text-gray-700 font-medium">Confirmer Mot de passe</label>
                <input type="password" name="mot_de_passe2" id="mot_de_passe2" minlength="6" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                S'inscrire
            </button>
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
                alert("Veuillez entrer un numéro de téléphone valide (8 à 15 chiffres, optionnellement précédé de +).");
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
