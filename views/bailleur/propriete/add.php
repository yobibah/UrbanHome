<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php require_once VIEW_PATH . '/bailleur/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Nouvelle Propriété</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen font-sans">
    <?php if (isset($_SESSION['id'])) : ?>
        <div class="w-full max-w-6xl mx-auto px-4 md:px-8 py-12">
            <form action="/add" method="POST" enctype="multipart/form-data"
                class="bg-white p-8 rounded-xl shadow-md space-y-0">

                <h2 class="text-3xl font-semibold text-blue-600 mb-4">Ajouter une nouvelle propriété</h2>

                <div>
                    <label for="option" class="block font-medium text-gray-700 mb-1">Option (location/vente)</label>
                    <select name="opt" id="option" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="location">Location</option>
                        <option value="vente">Vente</option>
                    </select>
                </div>

                <div>
                    <label for="adresse" class="block font-medium text-gray-700 mb-1">Adresse</label>
                    <input type="text" name="adresse" id="adresse" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>

                <div>
                    <label for="prix" class="block font-medium text-gray-700 mb-1">Prix</label>
                    <input type="text" name="prix" id="prix" class="w-full border border-gray-300 rounded-lg p-2" required>
                </div>

                <div>
                    <label for="description" class="block font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2 resize-y min-h-[100px]" required></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="im1" class="block font-medium text-gray-700 mb-1">Image 1</label>
                        <input type="file" name="im1" id="im1" class="w-full border border-gray-300 rounded-lg p-2" required accept=".jpg,.jpeg,.png,.webp">
                    </div>
                    <div>
                        <label for="im2" class="block font-medium text-gray-700 mb-1">Image 2</label>
                        <input type="file" name="im2" id="im2" class="w-full border border-gray-300 rounded-lg p-2" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                    <div>
                        <label for="im3" class="block font-medium text-gray-700 mb-1">Image 3</label>
                        <input type="file" name="im3" id="im3" class="w-full border border-gray-300 rounded-lg p-2" accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <div>
                    <label for="type" class="block font-medium text-gray-700 mb-1">Type de propriété</label>
                    <select name="type" id="type" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        <?php foreach ($types as $type) : ?>
                            <option value="<?= htmlspecialchars($type['id']) ?>"><?= htmlspecialchars($type['objet']->getlibele()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="text-right">
                    <input type="submit" value="Valider"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 mt-2 rounded-lg font-semibold cursor-pointer transition duration-200">
                </div>
            </form>
        </div>
    <?php else : ?>
        <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-md mx-auto mt-20">
            <h1 class="text-2xl font-bold text-red-600 mb-3">Accès refusé</h1>
            <p class="text-gray-700 mb-4">Vous devez être connecté pour accéder à cette page.</p>
            <a href="/connexion"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                Se connecter
            </a>
        </div>
    <?php endif; ?>
</body>

</html>