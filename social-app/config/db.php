<?php
$host = 'localhost';
$dbname = 'social_app';
$username = 'root';
$password = 'root';
$port = 8889;

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}