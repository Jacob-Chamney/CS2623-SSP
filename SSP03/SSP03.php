<?php

declare(strict_types=1);

require_once __DIR__ . '/PHP/functions_ss03.php';

$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$current_day = (int)$now->format('N');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2623 SSP03: Chamney</title>
    <link rel="stylesheet" href="../SSP01/main.css">
    <link rel="stylesheet" href="CSS/table.css">
</head>
<body>
    <?php require_once __DIR__ . "/PHP/include_header.php"; ?>
    <div id="page-wrapper">
        <?php require_once __DIR__ . "/PHP/include_leftNav.php"; ?>
        <main>
            <?php require_once __DIR__ . "/PHP/include_topNav.php"; ?>
            <?php
            fn_tableOpen('CS-2623 Weekly Study Planner');
            for ($day = 1; $day <= 7; $day++) {
                $name    = fn_dayOfWeek($day);
                $details = fn_dayDetails($day);
                $time    = fn_dayTime($day);
                if ($day === $current_day) {
                    fn_tableRowCurrent($name, $details, $time);
                } else {
                    fn_tableRow($name, $details, $time);
                }
            }
            fn_tableClose();
            ?>
        </main>
    </div>
    <?php require_once __DIR__ . "/PHP/include_footer.php"; ?>
</body>
</html>
