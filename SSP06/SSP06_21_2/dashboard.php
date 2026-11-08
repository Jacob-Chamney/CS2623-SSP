<?php

declare(strict_types=1);

require 'auth.php';

$loginTime = (new DateTime('@' . $_SESSION['login_at']))
    ->setTimezone(new DateTimeZone('America/Chicago'))
    ->format('g:i A');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CS2623 Dashboard</title>
    </head>
    <body>
        <h1>Welcome, <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?>!</h1>
        <p>Logged in at: <?= htmlspecialchars($loginTime, ENT_QUOTES, 'UTF-8') ?></p>
        <p><a href="profile.php">View profile</a></p>
        <p><a href="logout.php">Log out</a></p>
    </body>
</html>
