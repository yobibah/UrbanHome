<?php ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= isset($title) ? htmlspecialchars($title) : 'UrbanHome' ?></title>
    <link rel="stylesheet" href="<?= ASSET_PATH ?>css/main.css">
    <link rel="stylesheet" href="<?= ASSET_PATH ?>css/home.css">
    <link rel="icon" href="<?= ASSET_PATH ?>images/flavicon.png" type="image/x-icon">
    <script src="<?= ASSET_PATH ?>js/main.js" defer></script>
</head>

<body>
    <header>
        <div class="burger" id="burgerMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="logo">
            <a href="/home">
                <img src="<?= ASSET_PATH ?>images/flavicon.png" alt="UrbanHome Logo" class="logo-img">
                <h1 class="logo-text">UrbanHome</h1>
            </a>
        </div>
        <?php include __DIR__ . '/navbar.php'; ?>
        <div class="auth">
            <span class="auth-icon">&#128100;</span>
            <span class="auth-text"><a href="/login" style="color:#fff;text-decoration:none;">Se connecter</a></span>
        </div>
    </header>