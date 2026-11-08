<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION['user'])) {
    $loginPath = $loginPath ?? 'login.php';
    header('Location: ' . $loginPath);
    exit;
}
