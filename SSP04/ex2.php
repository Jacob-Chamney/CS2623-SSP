<?php

require_once dirname(__DIR__) . "/PHP/functions.php";

// timezone setup
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);

// current date and time
$today_name = $now->format('l');
$today_date = $now->format('F j, Y');
$today_time = $now->format('g:i:s A');

// parse a birthdate
$birth_str = '2000-10-17';
$birth_date = DateTime::createFromFormat('Y-m-d', $birth_str, $tz);

// calculate age in years and days
$age_interval = $birth_date->diff($now);
$age_years = $age_interval->y;
$age_days = $age_interval->days;

// countdown to end of semester
$end_date = new DateTime('2026-12-12', $tz);
$interval = $now->diff($end_date);
$days_left = $interval->days;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS2623 SSP04: Chamney</title>
    <link rel="stylesheet" href="../CSS/main.css">
    <link rel="stylesheet" href="../CSS/table.css">
</head>
<body>
    <?php require_once dirname(__DIR__) . "/PHP/include_header.php"; ?>
    <div id="page-wrapper">
        <?php require_once dirname(__DIR__) . "/PHP/include_leftNav.php"; ?>
        <main>
            <?php require_once dirname(__DIR__) . "/PHP/include_topNav.php"; ?>            
            <div class="center-text">
                <h1>Date & Time Demonstrations</h1>
                <!-- current date and time -->
                <h2>Current Date & Time</h2>
                    <p>Today is: <strong><?php e($today_name . ', ' . $today_date); ?></strong></p>
                    <p>Current time (CDT): <strong><?php e($today_time); ?></strong></p>
                <!-- age calculate -->
                <h2>Age Calculator</h2>
                    <p>Birthdate parsed: <strong><?php e($birth_date->format('F j, Y')); ?></strong></p>
                    <p>Age: <strong><?php e((string)$age_years); ?></strong> years old.</p>
                    <p>That is exactly <strong><?php e((string)$age_days); ?></strong> days.</p>
                <!-- countdown -->
                <h2>Semester Countdown</h2>
                    <p>Target date: <strong><?php e($end_date->format('F j, Y')); ?></strong></p>
                    <p>Time remaining: <strong><?php e(formatInterval($interval)); ?></strong></p>
                    <p>Days until semester end: <strong><?php e((string)$days_left); ?></strong> days</p>
            </div>
        </main>
    </div>
    <?php require_once dirname(__DIR__) . "/PHP/include_footer.php"; ?>
</body>
</html>
