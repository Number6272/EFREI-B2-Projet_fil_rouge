<?php
session_start();
require '../config/db.php';

$email    = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['error'] = "Email ou mot de passe incorrect.";
    header('Location: ../pages/login.php');
    exit;
}

$_SESSION['user_id']  = $user['id'];
$_SESSION['username'] = $user['username'];

header('Location: ../index.php');
exit;