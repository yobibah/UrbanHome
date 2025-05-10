<?php include __DIR__ . '/../layout/header.php'; ?>
<h2>Tableau de bord Client</h2>
<?php if (isset($client)) : ?>
    <p>Bienvenue, <strong><?php echo htmlspecialchars($client); ?></strong> !</p>
    <a href="/client/logout">Se déconnecter</a>
<?php else : ?>
    <p>Bienvenue, cher client !</p>
<?php endif; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
