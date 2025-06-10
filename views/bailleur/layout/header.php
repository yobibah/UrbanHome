<<<<<<< HEAD
<?php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'UrbanHome' ?></title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <script src="assets/js/main.js"></script>
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
=======
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= ASSET_PATH ?>css/bailleur.css">
    <!-- Sidebar -->
    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-700 text-white p-6 space-y-6">
            <h2 class="text-2xl font-bold">Espace Bailleur</h2>
            <?php require_once VIEW_PATH . 'bailleur/layout/navbar.php'; ?>
        </aside>
>>>>>>> b7b303adf4a1e36aab518f34d312ece15044b7e3
