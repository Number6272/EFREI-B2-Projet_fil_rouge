<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

require '../includes/header.php';
require '../includes/navbar.php';
?>

<main class="auth-page">
    <div class="auth-card">
        <div class="auth-glow"></div>

        <h1 class="auth-title">SE <span>CONNECTER</span></h1>
        <p class="auth-subtitle">Accède à ton espace</p>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../actions/login_action.php" method="POST" class="auth-form">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary">SE CONNECTER</button>
        </form>

        <p class="auth-switch">Pas de compte ? <a href="../pages/register.php">S'inscrire</a></p>
    </div>
</main>

<?php require '../includes/footer.php'; ?>