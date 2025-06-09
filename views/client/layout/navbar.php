    <script src="https://cdn.tailwindcss.com"></script>
    <?php isset($_SESSION['id']) ? $encodedId = base64_encode($_SESSION['id']) : null ?>
    <!-- Sidebar -->
    <div class="flex min-h-screen">
      <aside class="w-64 bg-blue-700 text-white p-6 space-y-6">
        <h2 class="text-2xl font-bold">Espace Client</h2>
        <nav class="space-y-2">
          <a href="/tableau-de-bord" class="block px-4 py-2 rounded hover:bg-blue-600">Tableau de bord</a>

          <a href="/mes-proprietes" class="block px-4 py-2 rounded hover:bg-blue-600">Locations | Achats</a>

       
          <a href="/listes-proprietes" class="block px-4 py-2 rounded hover:bg-blue-600"> Voir Proprietes</a>
          <a href="/propriete/mes-proprietes-favoris" class="block px-4 py-2 rounded hover:bg-blue-600"> Favoris</a>
          <a href="Mon-profil?id=<?= isset($encodedId) ? $encodedId : null ?>" class="block px-4 py-2 rounded hover:bg-blue-600">Profil</a>
          <a href="#"
            onclick="openLogoutModal()"
            class="block px-4 py-2 rounded hover:bg-red-600 text-red-200">
            Déconnexion
          </a>
          <!-- Modal de confirmation -->
          <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl">
              <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirmer la déconnexion</h2>
              <p class="text-sm text-gray-600 mb-6">Êtes-vous sûr de vouloir vous déconnecter ?</p>
              <div class="flex justify-end space-x-3">
                <button onclick="closeLogoutModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                  Annuler
                </button>
                <a href="/logout" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                  Se déconnecter
                </a>
              </div>
            </div>
          </div>



        </nav>
      </aside>

      <script>
        function openLogoutModal() {
          document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
          document.getElementById('logoutModal').classList.add('hidden');
        }
      </script>