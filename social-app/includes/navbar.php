<nav>
    <a href="/social-app/index.php" class="nav-logo">Inter-Knot</a>
    <div class="nav-links">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/social-app/index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Accueil</a>
            <a href="/social-app/pages/profile.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">Profil</a>
            <a href="/social-app/actions/logout.php" class="nav-link nav-logout">Déconnexion</a>
        <?php else: ?>
            <a href="/social-app/pages/login.php" class="nav-link">Connexion</a>
            <a href="/social-app/pages/register.php" class="nav-link">Inscription</a>
        <?php endif; ?>
    </div>
</nav>