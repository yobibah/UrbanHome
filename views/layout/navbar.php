<nav>
    <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="/propriete">Propriété</a></li>
        <li><a href="/client">
                <?php if (isset($_SESSION['id_client'])): ?>
                    Mon espace client
                <?php else: ?>
                    Espace Client
                <?php endif; ?>
            </a></li>
        <li><a href="/bailleur">Espace Bailleur</a></li>
        <li><a href="/manager">Espace Manager</a></li>
        <!-- Ajoute d'autres liens si besoin -->
    </ul>
</nav>