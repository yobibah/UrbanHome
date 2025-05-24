<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-2xl px-8 pt-10 pb-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-blue-600 text-center mb-6">Connexion Client</h2>

        <form method="POST" action="index.php?action=connexionClient" class="space-y-4">
            <div>
                <label for="email" class="block text-gray-700 font-medium">Adresse e-mail</label>
                <input type="email" name="email" id="email" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="mot_de_passe" class="block text-gray-700 font-medium">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                Se connecter
            </button>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">Vous êtes bailleur ? 
                <a href="/connection-bailleur" class="text-blue-600 hover:underline font-medium">
                    Connectez-vous ici
                </a>
            </p>
        </div>
    </div>

</body>
</html>
