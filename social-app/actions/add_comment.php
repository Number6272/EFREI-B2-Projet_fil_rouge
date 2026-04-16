<?php
session_start();
require '../config/db.php';

$post_id = $_POST['post_id'];
$contenu = $_POST['contenu'];

$stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, contenu) VALUES (?, ?, ?)");
$stmt->execute([$post_id, $_SESSION['user_id'], $contenu]);

header('Location: ../index.php');
exit;