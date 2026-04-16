<?php
require '../includes/auth_check.php';
require '../includes/header.php';
require '../includes/navbar.php';
require '../config/db.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

$avatar = $user['avatar'] ? '../assets/images/' . $user['avatar'] : '../assets/images/default-avatar.png';

?>

<div class="profile">
    <img src="<?= htmlspecialchars($avatar) ?>" alt="Photo de profil" style="width:120px; height:120px; object-fit:cover; border-radius:50%;">

    <h2><?= htmlspecialchars($user['username']) ?></h2>
    <p><?= htmlspecialchars($user['email']) ?></p>

    <form action="../actions/update_avatar.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="avatar" accept="image/*" required>
        <button type="submit">Changer la photo</button>
    </form>
    
</div>

<?php require '../includes/footer.php'; ?>