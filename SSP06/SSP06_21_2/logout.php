<?php

//declare(strict_types=1);

session_start();
$_SESSION = [];
setcookie('remember_user', '', time() - 3600, '/', '', false, true);
session_destroy();
header('Location: login.php');
exit;
