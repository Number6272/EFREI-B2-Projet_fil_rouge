<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /social-app/pages/login.php');
    exit;
}