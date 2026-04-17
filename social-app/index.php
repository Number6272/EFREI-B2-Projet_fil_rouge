<?php
require 'includes/auth_check.php';
require 'includes/header.php';
require 'includes/navbar.php';
require 'config/db.php';

$stmt = $pdo->query("SELECT posts.*, users.username, users.avatar, COUNT(likes.id) as nb_likes FROM posts JOIN users ON posts.user_id = users.id LEFT JOIN likes ON posts.id = likes.post_id GROUP BY posts.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();
?>

<div class="page-content">

<form class="form-post" action="actions/add_post.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="titre" placeholder="Titre" required>
    <textarea name="contenu" placeholder="Contenu..." required></textarea>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Publier</button>
</form>

<div class="posts-grid">
<?php foreach ($posts as $post): ?>

    <?php $avatar = !empty($post['avatar']) ? 'assets/images/' . $post['avatar'] : 'assets/images/default-avatar.png'; ?>

    <div class="post" onclick="openModal(<?= $post['id'] ?>)">
        <?php if (!empty($post['image'])): ?>
            <img src="assets/images/<?= htmlspecialchars($post['image']) ?>" class="post-image">
        <?php else: ?>
            <img src="assets/images/default-post.png" class="post-image">
        <?php endif; ?>

        <div class="post-info">
            <div class="post-header">
                <img src="<?= htmlspecialchars($avatar) ?>" class="avatar">
                <strong><?= htmlspecialchars($post['username']) ?></strong>
            </div>
            <h3><?= htmlspecialchars($post['titre']) ?></h3>
            <p><?= htmlspecialchars($post['contenu']) ?></p>
        </div>
    </div>

    <div class="modal-overlay" id="modal-<?= $post['id'] ?>" onclick="closeModal(<?= $post['id'] ?>)">
        <div class="modal" onclick="event.stopPropagation()">

            <div class="modal-left">
                <?php if (!empty($post['image'])): ?>
                    <img src="assets/images/<?= htmlspecialchars($post['image']) ?>">
                <?php else: ?>
                    <img src="assets/images/default-post.png">
                <?php endif; ?>
            </div>

            <div class="modal-right">
                <div class="modal-author">
                    <img src="<?= htmlspecialchars($avatar) ?>" class="avatar">
                    <strong><?= htmlspecialchars($post['username']) ?></strong>
                </div>

                <h3><?= htmlspecialchars($post['titre']) ?></h3>
                <p><?= htmlspecialchars($post['contenu']) ?></p>
                <small><?= htmlspecialchars($post['created_at']) ?></small>

                <?php if ($post['user_id'] == $_SESSION['user_id']): ?>
                    <form action="actions/delete_post.php" method="POST">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                        <button type="submit">🗑️</button>
                    </form>
                <?php endif; ?>

                <?php
                $stmt3 = $pdo->prepare("SELECT id FROM likes WHERE post_id = ? AND user_id = ?");
                $stmt3->execute([$post['id'], $_SESSION['user_id']]);
                $user_liked = $stmt3->fetch();
                ?>

                <div class="likes">
                    <span><?= $post['nb_likes'] ?> like</span>
                    <?php if ($user_liked): ?>
                        <form action="actions/unlike_post.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button type="submit">❤️</button>
                        </form>
                    <?php else: ?>
                        <form action="actions/like_post.php" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button type="submit">🤍</button>
                        </form>
                    <?php endif; ?>
                </div>

                <?php
                $stmt2 = $pdo->prepare("SELECT comments.*, users.username, users.avatar FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY created_at ASC");
                $stmt2->execute([$post['id']]);
                $comments = $stmt2->fetchAll();
                ?>

                <div class="modal-comments">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <?php $comment_avatar = !empty($comment['avatar']) ? 'assets/images/' . $comment['avatar'] : 'assets/images/default-avatar.png'; ?>
                            <img src="<?= htmlspecialchars($comment_avatar) ?>" class="avatar">
                            <div>
                                <strong><?= htmlspecialchars($comment['username']) ?></strong>
                                <p><?= htmlspecialchars($comment['contenu']) ?></p>
                            </div>
                            <?php if ($comment['user_id'] == $_SESSION['user_id']): ?>
                                <form action="actions/delete_comment.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                                    <button type="submit">🗑️</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                    <form class="form-comment" action="actions/add_comment.php" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <input type="text" name="contenu" placeholder="Ajouter un commentaire..." required>
                        <button type="submit">Commenter</button>
                    </form>
                </div>

                <button class="btn-close" onclick="closeModal(<?= $post['id'] ?>)">Fermer</button>
            </div>
        </div>
    </div>

<?php endforeach; ?>
</div>

</div>

<?php require 'includes/footer.php'; ?>