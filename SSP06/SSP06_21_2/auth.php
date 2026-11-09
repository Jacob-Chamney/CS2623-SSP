<?php

//declare(strict_types=1);

session_start();

date_default_timezone_set('America/Chicago');

if (!isset($_SESSION['user'])) {
    $loginPath = isset($loginPath) ? $loginPath : 'login.php';
    header('Location: ' . $loginPath);
    exit;
}
