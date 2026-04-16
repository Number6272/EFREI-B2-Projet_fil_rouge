<?php
session_start();
require '../config/db.php';

$titre   = $_POST['titre'];
$contenu = $_POST['contenu'];
$image   = null;

if (!empty($_FILES['image']['name'])) {
    $filename = 'post_' . time() . '_' . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], '../assets/images/' . $filename);
    $image = $filename;
}

$stmt = $pdo->prepare("INSERT INTO posts (user_id, titre, contenu, image) VALUES (?, ?, ?, ?)");
$stmt->execute([$_SESSION['user_id'], $titre, $contenu, $image]);

header('Location: ../index.php');
exit;