<?php include __DIR__ . '/../layout/header.php'; ?>
<h2>Connexion Client</h2>
<form method="post" action="/client/authenticate">
    <input type="text" name="identifiant" placeholder="Identifiant" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
</form>
<?php include __DIR__ . '/../layout/footer.php'; ?>
