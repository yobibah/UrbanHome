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
<header>
    <div class="burger" id="burgerMenu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="logo">
        <img src="assets/images/flavicon.png" alt="Logo" />
        <span>UrbanHome</span>
    </div>
    <div class="auth">
        <span class="auth-icon">&#128100;</span>
        <span class="auth-text"><a href="/login" style="color:#fff;text-decoration:none;">Se connecter</a></span>
    </div>
</header>
<?php include __DIR__ . '/navbar.php'; ?>