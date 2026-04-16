<nav>
    <a href="/social-app/index.php">Accueil</a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <span>Bonjour, <?= $_SESSION['username'] ?></span>
        <a href="/social-app/actions/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="/social-app/pages/login.php">Connexion</a>
        <a href="/social-app/pages/register.php">Inscription</a>
    <?php endif; ?>
</nav>