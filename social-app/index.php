<?php
require 'includes/auth_check.php';
require 'includes/header.php';
require 'includes/navbar.php';
?>

<h2>Bienvenue, <?= $_SESSION['username'] ?> !</h2>
<p>Le feed arrive bientôt.</p>

<?php require 'includes/footer.php'; ?>