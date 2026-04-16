<?php
require '../includes/header.php';
require '../includes/navbar.php';
?>

<h2>Connexion</h2>

<?php if (isset($_SESSION['error'])): ?>
    <p style="color:red"><?= $_SESSION['error'] ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="/social-app/actions/login_action.php" method="POST">
    <input type="email"    name="email"    placeholder="Email"        required><br>
    <input type="password" name="password" placeholder="Mot de passe" required><br>
    <button type="submit">Se connecter</button>
</form>

<a href="/social-app/pages/register.php">Pas de compte ? S'inscrire</a>

<?php require '../includes/footer.php'; ?>