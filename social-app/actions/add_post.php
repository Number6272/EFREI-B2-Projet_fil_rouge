<?php
session_start();
require '../config/db.php';

$titre   = $_POST['titre'];
$contenu = $_POST['contenu'];

$stmt = $pdo->prepare("INSERT INTO posts (user_id, titre, contenu) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['user_id'], $titre, $contenu]);

header('Location: ../index.php');
exit;