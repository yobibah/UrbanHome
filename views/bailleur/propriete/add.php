<?php 

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Nouvelle Propriété</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
    <?php if (!empty($_SESSION['msg'])) : ?>
        <div id="flashMessage" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out">
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

    <?php if (isset($_SESSION['id'])) : ?>
        <form action="/add" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-xl shadow-lg w-full max-w-xl space-y-4">
            
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Ajouter une nouvelle propriété</h2>

            <div>
                <label for="" class="block font-medium text-gray-700 mb-1">Option(location/vente)</label>
                <select name="opt" id="option" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="location">Location</option>
                    <option value="vente">Vente</option>
                </select>

            </div>

            <div>
                <label for="adresse" class="block font-medium text-gray-700 mb-1">Adresse :</label>
                <input type="text" name="adresse" id="adresse" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label for="prix" class="block font-medium text-gray-700 mb-1">Prix :</label>
                <input type="text" name="prix" id="prix" class="w-full border border-gray-300 rounded p-2" required>
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700 mb-1">Description :</label>
                <textarea name="description" id="description"
                    class="w-full border border-gray-300 rounded p-2 resize-y min-h-[100px]" required></textarea>
            </div>

            <div>
                <label for="im1" class="block font-medium text-gray-700 mb-1">Image 1 :</label>
                <input type="file" name="im1" id="im1" class="w-full border border-gray-300 rounded p-2" required accept=".jpg,.jpeg,.png,.webp" />
            </div>

            <div>
                <label for="im2" class="block font-medium text-gray-700 mb-1">Image 2 :</label>
                <input type="file" name="im2" id="im2" class="w-full border border-gray-300 rounded p-2" accept=".jpg,.jpeg,.png,.webp" />
            </div>

            <div>
                <label for="im3" class="block font-medium text-gray-700 mb-1">Image 3 :</label>
                <input type="file" name="im3" id="im3" class="w-full border border-gray-300 rounded p-2" accept=".jpg,.jpeg,.png,.webp" />
            </div>

            <div>
                <label for="type" class="block font-medium text-gray-700 mb-1">Type de propriété :</label>
                <select name="type" id="type" class="w-full border border-gray-300 rounded p-2" required>
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= htmlspecialchars($type['id']) ?>"><?= htmlspecialchars($type['objet']->getlibele()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-right">
                <input type="submit" value="Valider"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold cursor-pointer">
            </div>
        </form>
    <?php else : ?>
        <div class="bg-white p-6 rounded-xl shadow-lg text-center max-w-md">
            <h1 class="text-xl font-bold text-red-600 mb-4">Accès refusé</h1>
            <p class="text-gray-700 mb-4">Vous devez être connecté pour accéder à cette page.</p>
            <a href="/connexion"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-medium">
                Se connecter
            </a>
        </div>
    <?php endif; ?>

</body>

</html>
