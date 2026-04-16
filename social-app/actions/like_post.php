<?php
session_start();
require '../config/db.php';

$post_id = $_POST['post_id'];

$stmt = $pdo->prepare("INSERT IGNORE INTO likes (post_id, user_id) VALUES (?, ?)");
$stmt->execute([$post_id, $_SESSION['user_id']]);

header('Location: ../index.php');
exit;