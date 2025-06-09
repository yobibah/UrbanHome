<script src="https://cdn.tailwindcss.com"></script>

<div class="flex min-h-screen">

  <!-- Contenu principal -->
  <main class="flex-1 p-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Bienvenue sur votre Dashboard, <?= htmlspecialchars($prenom) ?> 👋</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Mes propriétés -->
      <a href="/mes-proprietes" class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-lg transition duration-200">
        <h2 class="text-lg font-semibold text-gray-700">Mes propriétés</h2>
        <p class="text-3xl font-bold text-blue-600 mt-2"><?= $nombreProprietes ?></p>
        <p class="text-sm text-gray-500 mt-2">Voir mes annonces publiées</p>
      </a>

      <!-- Mes rendez-vous -->
      <a href="/mes-rendez-vous" class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-lg transition duration-200">
        <h2 class="text-lg font-semibold text-gray-700">Rendez-vous à venir</h2>
        <p class="text-3xl font-bold text-green-600 mt-2"><?= $rdvAvenir ?></p>
        <p class="text-sm text-gray-500 mt-2">Voir le planning</p>
      </a>

      <!-- Mes favoris -->
      <a href="/propriete/mes-proprietes-favoris" class="bg-white p-6 rounded-xl shadow-md text-center hover:shadow-lg transition duration-200">
        <h2 class="text-lg font-semibold text-gray-700">Favoris</h2>
        <p class="text-3xl font-bold text-pink-600 mt-2"><?= $favoris ?></p>
        <p class="text-sm text-gray-500 mt-2">Voir les biens enregistrés</p>
      </a>

    </div>
  </main>
</div>

<!-- Modal de déconnexion -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirmer la déconnexion</h2>
    <p class="text-sm text-gray-600 mb-6">Êtes-vous sûr de vouloir vous déconnecter ?</p>
    <div class="flex justify-end space-x-3">
      <button onclick="closeLogoutModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Annuler</button>
      <a href="/logout" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Se déconnecter</a>
    </div>
  </div>
</div>

<script>
  function openLogoutModal() {
    document.getElementById('logoutModal').classList.remove('hidden');
  }

  function closeLogoutModal() {
    document.getElementById('logoutModal').classList.add('hidden');
  }
</script>
