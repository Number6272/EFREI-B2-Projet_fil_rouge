<?php
session_start();
require '../config/db.php';

$file = $_FILES['avatar'];

$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
if (!in_array($extension, $allowed)) {
    die("Format non autorisé");
}

$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = 'avatar_' . $_SESSION['user_id'] . '.' . $extension;
$destination = '../assets/images/' . $filename;

move_uploaded_file($file['tmp_name'], $destination);

$stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
$stmt->execute([$filename, $_SESSION['user_id']]);

header('Location: ../pages/profile.php');
exit;