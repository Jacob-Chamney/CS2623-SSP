<?php

//declare(strict_types=1); not introduced until PHP 7.0, so we will not use it here.

date_default_timezone_set('America/Chicago');

use CS2623\Week4\FormatException;
use CS2623\Week4\ValidationException;

function fn_tableOpen($caption)
{
    echo '<table border="1" cellpadding="6" cellspacing="0">';
    echo '<tr style="background-color:#1B2A6B;color:#FFFFFF;">';
    echo ' <th colspan="3">';
    echo htmlspecialchars($caption, ENT_QUOTES, 'UTF-8');
    echo ' </th>';
    echo '</tr>';
    echo '<tr style="background-color:#006B7D;color:#FFFFFF;">';
    echo '<th>Day</th>
    <th>Details</th>
    <th>Time</th>';
    echo '
    </tr>';
}

function fn_tableClose()
{
    echo '</table>';
}

function fn_tableRowCurrent($day, $details, $time)
{
    echo '<tr style="background-color:#FFFF66;">';
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') .
        '</td>';
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

function fn_tableRow($day, $details, $time)
{
    echo '<td>' . htmlspecialchars($day, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '<td>' . htmlspecialchars($details, ENT_QUOTES, 'UTF-8') .
        '</td>';
    echo '<td>' . htmlspecialchars($time, ENT_QUOTES, 'UTF-8') . '</td>';
    echo '</tr>';
}

function fn_dayOfWeek($day_num)
{
    if ($day_num === 1) {
        return 'Monday';
    } elseif ($day_num === 2) {
        return 'Tuesday';
    } elseif ($day_num === 3) {
        return 'Wednesday';
    } elseif ($day_num === 4) {
        return 'Thursday';
    } elseif ($day_num === 5) {
        return 'Friday';
    } elseif ($day_num === 6) {
        return 'Saturday';
    } elseif ($day_num === 7) {
        return 'Sunday';
    } else {
        return '';
    }
}

function fn_dayDetails($day_num)
{
    switch ($day_num) {
        case 1:
            return 'Slack off + poweroint presentations';
        case 2:
            return 'SSP03 homework + poweroint presentations';
        case 3:
            return 'SSP03 homework';
        case 4:
            return 'SSP04 homework';
        case 5:
            return 'SSP04 homework';
        case 6:
            return 'Week 2 quizes';
        case 7:
            return 'Rest day';
        default:
            return 'No schedule';
    }
}

function fn_dayTime($day_num)
{
    if ($day_num === 1 || $day_num === 3) {
        return '9:00 AM - 10:20 AM';
    } elseif ($day_num === 2 || $day_num === 4) {
        return '1:00 PM - 2:50 PM';
    } elseif ($day_num === 5) {
        return '10:00 AM - 11:00 AM';
    } elseif ($day_num === 6 || $day_num === 7) {
        return 'Flexible';
    } else {
        return 'TBD';
    }
}


// helper for echoing and escaping strings
function e($string)
{
    echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}


// Helper to format intervals nicely for display
function formatInterval($interval)
{
    $days = $interval->days;
    $hours = $interval->h;
    $minutes = $interval->i;
    return "{$days} days, {$hours} hours, {$minutes} minutes";
}

// validation function for contact form
function validateContact(array $data)
{
    $errors = [];
    // ZIP code
    $zip = isset($data['zip']) ? $data['zip'] : '';
    if (!preg_match('/^\d{5}(-\d{4})?$/', $zip)) {
        $errors[] = 'ZIP must be 5 digits or ZIP+4 (e.g. 74103 or 74103-1234).';
    }

    // Website
    if (!filter_var(isset($data['website']) ? $data['website'] : '', FILTER_VALIDATE_URL)) {
        $errors[] = 'Invalid website URL.';
    }

    // Age
    $age = filter_var(
        isset($data['age']) ? $data['age'] : '',
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1, 'max_range' => 120]]
    );

    if ($age === false) {
        $errors[] = 'Age must be a whole number between 1 and 120.';
    } else {
        $data['age'] = $age;
    }

    // Email
    if (!filter_var(isset($data['email']) ? $data['email'] : '', FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    // Phone
    $phone = isset($data['phone']) ? $data['phone'] : '';
    if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
        $errors[] = 'Phone must be in format 555-555-5555.';
    }

    if ($errors) {
        throw new ValidationException(implode(' | ', $errors));
    }

    $code = isset($data['product_code']) ? $data['product_code'] : '';
    if (!preg_match('/^[A-Z]{2}\d{4}$/', $code)) {
        throw new FormatException(
            'Product code must be two uppercase letters followed by four digits (e.g. AB1234).'
        );
    }
    return $data;
}
