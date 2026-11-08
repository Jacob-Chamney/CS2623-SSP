<?php

declare(strict_types=1);

session_start();
$_SESSION = [];
setcookie('remember_user', '', [
    'expires' => time() - 3600,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax',
]);
session_destroy();
header('Location: login.php');
exit;
