<nav>
    <a href="/test2/social-app/index.php">Accueil</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <span>Bonjour, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a href="/test2/social-app/actions/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="/test2/social-app/pages/login.php">Connexion</a>
        <a href="/test2/social-app/pages/register.php">Inscription</a>
    <?php endif; ?>
</nav>