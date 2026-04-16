<?php
require '../includes/header.php';
require '../includes/navbar.php';
?>

<h2>Inscription</h2>

<?php if (isset($_SESSION['error'])): ?>
    <p style="color:red"><?= $_SESSION['error'] ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<form action="/social-app/actions/register_action.php" method="POST">
    <input type="text"     name="username" placeholder="Nom d'utilisateur" required><br>
    <input type="email"    name="email"    placeholder="Email"              required><br>
    <input type="password" name="password" placeholder="Mot de passe"       required><br>
    <button type="submit">S'inscrire</button>
</form>

<a href="/social-app/pages/login.php">Déjà un compte ? Se connecter</a>

<?php require '../includes/footer.php'; ?>