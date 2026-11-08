<?php

declare(strict_types=1);

require 'auth.php';

$navBase = '../../';

$loginTime = (new DateTime('@' . $_SESSION['login_at']))
    ->setTimezone(new DateTimeZone('America/Chicago'))
    ->format('g:i A');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CS2623 SSP06 Profile: Chamney</title>
        <link rel="stylesheet" href="../../CSS/main.css">
    </head>
    <body>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_header.php"; ?>
        <div id="page-wrapper">
            <main class="center-text">
                <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_topNav.php"; ?>

                <h1>Profile</h1>
                <p>Username: <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>Logged in at: <?= htmlspecialchars($loginTime, ENT_QUOTES, 'UTF-8') ?></p>
                <p><a href="dashboard.php">Back to dashboard</a></p>
                <p><a href="logout.php">Log out</a></p>
            </main>
        </div>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_footer.php"; ?>
    </body>
</html>
