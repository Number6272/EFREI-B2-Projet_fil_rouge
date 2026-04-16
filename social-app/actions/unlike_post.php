<?php
session_start();
require '../config/db.php';

$post_id = $_POST['post_id'];

$stmt = $pdo->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
$stmt->execute([$post_id, $_SESSION['user_id']]);

header('Location: ../index.php');
exit;