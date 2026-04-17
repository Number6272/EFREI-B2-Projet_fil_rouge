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

<div class="page-content">
    <div class="profile-card">

        <img src="<?= htmlspecialchars($avatar) ?>" class="profile-avatar">

        <div class="profile-info">
            <h2><?= htmlspecialchars($user['username']) ?></h2>
            <p><?= htmlspecialchars($user['email']) ?></p>

            <form action="../actions/update_avatar.php" method="POST" enctype="multipart/form-data" class="form-avatar">
                <input type="file" name="avatar" accept="image/*" required>
                <button type="submit" class="btn-avatar">Changer la photo</button>
            </form>
        </div>

    </div>
</div>

<?php require '../includes/footer.php'; ?>