<?php
session_start();
require '../config/db.php';

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);

header('Location: ../index.php');
exit;