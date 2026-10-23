<?php

declare(strict_types=1);

require_once __DIR__ . '/PHP/functions_ss03.php';
require_once __DIR__ . '/PHP/include_header.php';

// Apollo timezone fix
$tz = new DateTimeZone('America/Chicago');
$now = new DateTime('now', $tz);
$current_day = (int)$now->format('N'); // 1 (for Monday) through 7 (for Sunday)

fn_tableOpen('CS-2623 Weekly Study Planner');

for ($day = 1; $day <= 7; $day++) {
    $name = fn_dayOfWeek($day);
    $details = fn_dayDetails($day);
    $time = fn_dayTime($day);

    if ($day === $current_day) {
        fn_tableRowCurrent($name, $details, $time);
    } else {
        fn_tableRow($name, $details, $time);
    }
}

fn_tableClose();

require_once __DIR__ . '/PHP/include_footer.php';
