<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /social-app/index.php');
    exit;
}

require '../includes/header.php';
require '../includes/navbar.php';
?>

<main class="auth-page">
    <div class="auth-card">
        <div class="auth-glow"></div>

        <h1 class="auth-title">CRÉER UN <span>COMPTE</span></h1>
        <p class="auth-subtitle">Rejoins ZZZ</p>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../actions/register_action.php" method="POST">

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="ton_pseudo" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary">S'INSCRIRE</button>
        </form>

        <p class="auth-switch">Déjà un compte ? <a href="/social-app/pages/login.php">Se connecter</a></p>
    </div>
</main>

<?php require '../includes/footer.php'; ?>