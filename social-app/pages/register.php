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

        <h2>Créer un compte</h2>

        <?php if (!empty($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../actions/register_action.php" method="POST" class="auth-form">
            <label>Nom d'utilisateur</label>
            <input type="text" name="username" placeholder="ton_pseudo" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="exemple@mail.com" required>

            <label>Mot de passe</label>
            <input type="password" name="password" placeholder="••••••••" required>

            <label>Confirmer le mot de passe</label>
            <input type="password" name="confirm_password" placeholder="••••••••" required>

            <button type="submit" class="btn-auth">S'INSCRIRE</button>
        </form>

        <p class="auth-switch">Déjà un compte ? <a href="../pages/login.php">Se connecter</a></p>
    </div>
</div>

<?php require '../includes/footer.php'; ?>