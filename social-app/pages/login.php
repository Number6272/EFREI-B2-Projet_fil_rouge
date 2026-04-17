<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

require '../includes/header.php';
require '../includes/navbar.php';
?>

<div class="page-content">
    <div class="auth-card">

        <h2>Se connecter</h2>

        <?php if (!empty($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../actions/login_action.php" method="POST" class="auth-form">
            <label>Email</label>
            <input type="email" name="email" placeholder="exemple@mail.com" required>

            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <button type="submit" class="btn-auth">SE CONNECTER</button>
        </form>

        <p class="auth-switch">Pas de compte ? <a href="../pages/register.php">S'inscrire</a></p>
    </div>
</div>

<?php require '../includes/footer.php'; ?>