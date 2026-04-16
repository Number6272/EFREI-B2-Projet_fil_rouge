<?php
session_start();
session_destroy();
header('Location: /test2/social-app/pages/register.php');
exit;