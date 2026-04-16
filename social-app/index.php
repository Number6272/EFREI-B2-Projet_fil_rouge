<?php
require 'includes/auth_check.php';
require 'includes/header.php';
require 'includes/navbar.php';
require 'config/db.php';

$stmt = $pdo->query("SELECT posts.*, users.username, users.avatar , COUNT(likes.id) as nb_likes FROM posts JOIN users ON posts.user_id = users.id LEFT JOIN likes ON posts.id = likes.post_id GROUP BY posts.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();
?>

<form action="actions/add_post.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre" required>
    <textarea name="contenu" placeholder="Contenu..." required></textarea>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Publier</button>
</form>

<?php foreach ($posts as $post): ?>
    <div>
        <?php $avatar = !empty($post['avatar']) ? 'assets/images/' . $post['avatar'] : 'assets/images/default-avatar.png'; ?>
        <img src="<?= htmlspecialchars($avatar) ?>" style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
        <strong><?= htmlspecialchars($post['username']) ?></strong>

        <h3><?= htmlspecialchars($post['titre']) ?></h3>
        <p><?= htmlspecialchars($post['contenu']) ?></p>
        <small><?= htmlspecialchars($post['created_at']) ?></small>

        <?php if (!empty($post['image'])): ?>
            <img src="assets/images/<?= htmlspecialchars($post['image']) ?>" style="max-width:400px; max-height:300px;">
        <?php endif; ?>

        <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
            <form action="actions/delete_post.php" method="POST">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <button type="submit">Supprimer</button>
            </form>
        <?php endif; ?>

        <?php
        $stmt2 = $pdo->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY created_at ASC");
        $stmt2->execute([$post['id']]);
        $comments = $stmt2->fetchAll();
        ?>

        <?php foreach ($comments as $comment): ?>
            <div>
                <strong><?= htmlspecialchars($comment['username']) ?></strong>
                <p><?= htmlspecialchars($comment['contenu']) ?></p>

                <?php if ($comment['user_id'] == $_SESSION['user_id']): ?>
                    <form action="actions/delete_comment.php" method="POST">
                        <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <form action="actions/add_comment.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <input type="text" name="contenu" placeholder="Ajouter un commentaire..." required>
            <button type="submit">Commenter</button>
        </form>

        <?php
        $stmt3 = $pdo->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ?");
        $stmt3->execute([$post['id'], $_SESSION['user_id']]);
        $user_liked = $stmt3->fetch();
        ?>

        <span><?= htmlspecialchars($post['nb_likes']) ?> like(s)</span>

        <?php if ($user_liked): ?>
            <form action="actions/unlike_post.php" method="POST">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <button type="submit">Unlike</button>
            </form>

        <?php else: ?>
            <form action="actions/like_post.php" method="POST">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <button type="submit">Like</button>
            </form>
        <?php endif; ?>

    </div>
<?php endforeach; ?>

<?php require 'includes/footer.php'; ?>