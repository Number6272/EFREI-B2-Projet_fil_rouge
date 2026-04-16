<?php
session_start();
require '../config/db.php';

$username = $_POST['username'];
$email    = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $email]);

if ($stmt->fetch()) {
    $_SESSION['error'] = "Nom d'utilisateur ou email déjà utilisé.";
    header('Location: ../pages/register.php');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $password]);

$_SESSION['user_id']  = $pdo->lastInsertId();
$_SESSION['username'] = $username;

header('Location: ../index.php');
exit;
