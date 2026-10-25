<?php

require_once __DIR__ . "/PHP/functions_ss03.php";

// original string
$originalString = "Hello, World!";

// replace "World" with "PHP"
$modifiedString = str_replace("World", "PHP", $originalString);

// string contains check
// str_contains() is available in PHP 8.0 and later.
// for compatibility with earlier versions, we can use strpos() instead.
$containsCheck = strpos($originalString, "Hello") !== false;
$containsBool = $containsCheck ? "Yes" : "No";

// string to lowercase
$lowercaseString = strtolower($originalString);

// string to uppercase
$uppercaseString = strtoupper($originalString);

// string length
$stringLength = strlen($originalString);

// format a number as a decimal with 2 decimal places
$number = 1234.5678;
$formattedNumber = sprintf("$%.2f", $number);

// format a number with thousands separator
$numberWOformat = 10000000;
$numberWformat = number_format($numberWOformat);

// extract a substring
$substring = substr($originalString, 7, 5);

// create table of string functions
$stringFunctions = [
['str_replace()', "'World' -> 'PHP'", $modifiedString],
['str_contains()', "'Hello'", $containsBool],
['strtolower()', $originalString, $lowercaseString],
['strtoupper()', $originalString, $uppercaseString],
['strlen()', $originalString, $stringLength],
['sprintf("$%.2f")', $number, $formattedNumber],
['number_format()', $numberWOformat, $numberWformat],
['substr()', "'Hello, World!', 7, 5", $substring]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS2623 SSP04: Chamney</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/table.css">
</head>
    <body>
    <?php require_once __DIR__ . "/PHP/include_header.php"; ?>
    <div id="page-wrapper">
        <?php require_once __DIR__ . "/PHP/include_leftNav.php"; ?>
        <main>
                <?php require_once __DIR__ . "/PHP/include_topNav.php"; ?>
                <div class="center-text">
    <h1>PHP String Functions</h1>

    <h2>Original String</h2>
    <p><?php e($originalString); ?></p>

                    </div>
    <table class="data-table">
                    <caption>Function Demonstrations</caption>
        <thead>
            <tr>
                <th>Function</th>
                <th>Input</th>
                <th>Output</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stringFunctions as $row) : ?>
            <tr>
                <td><code><?php e($row[0]); ?></code></td>
                <td><?php e($row[1]); ?></td>
                <td><?php e($row[2]); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
                </table>
            </main>
        </div>
    <?php require_once __DIR__ . "/PHP/include_footer.php"; ?>
</body>
</html>
