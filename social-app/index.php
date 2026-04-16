<?php
require 'includes/auth_check.php';
require 'includes/header.php';
require 'includes/navbar.php';
require 'config/db.php';

$stmt = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
$posts = $stmt->fetchAll();

?>

<form action="actions/add_post.php" method="POST">
    <input type="text" name="titre" placeholder="Titre" required>
    <textarea name="contenu" placeholder="Contenu..." required></textarea>
    <button type="submit">Publier</button>
</form>

<?php foreach ($posts as $post): ?>
    <div>
        <h3><?= $post['titre'] ?></h3>
        <p><?= $post['contenu'] ?></p>
        <small>Par <?= $post['username'] ?> — <?= $post['created_at'] ?></small>

        <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
            <form action="actions/delete_post.php" method="POST">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <button type="submit">Supprimer</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php require 'includes/footer.php'; ?>