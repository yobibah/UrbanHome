
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-green-600 mb-6 text-center">Inscription Bailleur</h2>
        <form method="POST" action="/register" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nom" class="block text-gray-700 font-medium">Nom</label>
                    <input type="text" name="nom" id="nom" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label for="prenom" class="block text-gray-700 font-medium">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
                </div>
            </div>
            <div>
                <label for="raison_social" class="block text-gray-700 font-medium">Raison sociale</label>
                <input type="text" name="raison_social" id="raison_social"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="adresse" class="block text-gray-700 font-medium">Adresse</label>
                <input type="text" name="adresse" id="adresse"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="telephone" class="block text-gray-700 font-medium">Téléphone</label>
                <input type="text" name="telephone" id="telephone" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="mot_de_passe" class="block text-gray-700 font-medium">Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
                </div>
                <div>
                    <label for="confirm_mot_de_passe" class="block text-gray-700 font-medium">Confirmer le mot de passe</label>
                    <input type="password" name="confirm_mot_de_passe" id="confirm_mot_de_passe" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
                </div>
            </div>
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                S'inscrire
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Vous avez déjà un compte ?
            <a href="/connexion-bailleur" class="text-green-600 hover:underline">Se connecter</a>
        </p>
    </div>
</body>

</html>