<?php ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'UrbanHome' ?></title>
    <link rel="stylesheet" href="<?= ASSET_PATH ?>css/main.css">
    <link rel="stylesheet" href="<?= ASSET_PATH ?>css/home.css">
    <link rel="icon" href="/flavicon.png" type="image/x-icon">
    <script src="<?= ASSET_PATH ?>js/main.js" defer></script>
</head>

<body>
    <?php include __DIR__ . '/navbar.php'; ?>
    