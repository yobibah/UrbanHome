<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<?php require_once VIEW_PATH . 'public/layout/header.php'; ?>
<?php require_once VIEW_PATH . '/bailleur/layout/header.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Modifier une Propriété</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function validateForm() {
            const prix = document.getElementById('prix').value;
            if (isNaN(prix) || prix <= 0) {
                alert("Veuillez entrer un prix valide (nombre positif).");
                return false;
            }
            return true;
        }
    </script>
</head>
<div class="max-w-6xl mx-auto mt-12 px-6">
    <?php foreach ($propriete as $prop) : ?>
        <?php if (isset($_SESSION['id'])) : ?>
            <main class="bg-white p-8 rounded-xl shadow-lg space-y-6">
                <form action="/modifier" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <h2 class="text-3xl font-bold text-blue-600 mb-6">Modifier une propriété</h2>

                    <input type="hidden" name="id" value="<?= $prop['id'] ?>">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Option -->
                        <div>
                            <label for="option" class="block font-medium text-gray-700 mb-1">Option (location/vente)</label>
                            <select name="opt" id="option" class="w-full border border-gray-300 rounded p-2" required>
                                <option value="location" <?= $prop['objet']->getOpt() == 'location' ? 'selected' : '' ?>>Location</option>
                                <option value="vente" <?= $prop['objet']->getOpt() == 'vente' ? 'selected' : '' ?>>Vente</option>
                            </select>
                        </div>

                        <!-- Adresse -->
                        <div>
                            <label for="adresse" class="block font-medium text-gray-700 mb-1">Adresse :</label>
                            <input type="text" name="adresse" id="adresse" class="w-full border border-gray-300 rounded p-2"
                                value="<?= htmlspecialchars($prop['objet']->getAdresse()) ?>" required>
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="prix" class="block font-medium text-gray-700 mb-1">Prix :</label>
                            <input type="text" name="prix" id="prix" class="w-full border border-gray-300 rounded p-2"
                                value="<?= htmlspecialchars($prop['objet']->getPrix()) ?>" required>
                        </div>

                        <!-- Type de propriété -->
                        <div>
                            <label for="type" class="block font-medium text-gray-700 mb-1">Type de propriété :</label>
                            <select name="type" id="type" class="w-full border border-gray-300 rounded p-2" required>
                                <?php foreach ($types as $t) : ?>
                                    <option value="<?= $t['id'] ?>" <?= $t['id'] == $prop['objet']->getIdType() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($t['objet']->getlibele()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block font-medium text-gray-700 mb-1 mt-4">Description :</label>
                        <textarea name="description" id="description"
                            class="w-full border border-gray-300 rounded p-2 resize-y min-h-[100px]" required><?= htmlspecialchars($prop['objet']->getDescription()) ?></textarea>
                    </div>

                    <!-- Images -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                        <?php for ($i = 1; $i <= 3; $i++) : ?>
                            <div>
                                <label for="im<?= $i ?>" class="block font-medium text-gray-700 mb-1">Image <?= $i ?> :</label>
                                <?php $imageMethod = "getImage$i"; ?>
                                <?php if ($prop['objet']->$imageMethod()) : ?>
                                    <img src="/assets/images/<?= htmlspecialchars($prop['objet']->$imageMethod()) ?>" alt="Image <?= $i ?>" class="mb-2 w-full h-32 object-cover rounded">
                                <?php endif; ?>
                                <input type="file" name="im<?= $i ?>" id="im<?= $i ?>" class="w-full border border-gray-300 rounded p-2" accept=".jpg,.jpeg,.png,.webp">
                            </div>
                        <?php endfor; ?>
                    </div>

                    <?php $_SESSION['id_prop'] = $prop['id']; ?>

                    <!-- Submit -->
                    <div class="text-right pt-6">
                        <input type="submit" value="Valider"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-semibold cursor-pointer">

                            <a href="/detail_propriete?id=<?= base64_encode($prop['id']) ?>"
                        class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">Annuler</a>
                    </div>
                </form>
            </main>
        <?php else : ?>
            <div class="bg-white p-6 rounded-xl shadow-lg text-center max-w-md mx-auto mt-12">
                <h1 class="text-xl font-bold text-red-600 mb-4">Accès refusé</h1>
                <p class="text-gray-700 mb-4">Vous devez être connecté pour accéder à cette page.</p>
                <a href="/connexion"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-medium">
                    Se connecter
                </a>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

</html>
