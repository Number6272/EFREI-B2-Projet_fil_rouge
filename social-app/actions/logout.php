<?php
session_start();
session_destroy();
header('Location: /social-app/pages/register.php');
exit;