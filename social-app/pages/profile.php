<?php
require '../includes/auth_check.php';
require '../includes/header.php';
require '../includes/navbar.php';
require '../config/db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<div class="profile">
    <img src="../assets/images/default-avatar.png" alt="Photo de profil" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">

    <h2><?= htmlspecialchars($user['username']) ?></h2>
    <p><?= htmlspecialchars($user['email']) ?></p>
</div>

<?php require '../includes/footer.php'; ?>