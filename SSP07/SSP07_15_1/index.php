<?php

//declare(strict_types=1);

use CS2623\Week4\FormatException;
use CS2623\Week4\ValidationException;

require_once dirname(dirname(__DIR__)) . "/PHP/functions.php";
require_once __DIR__ . "/DatabaseException.php";
require_once __DIR__ . "/ValidationException.php";
require_once __DIR__ . "/FormatException.php";

$navBase = '../../';

$result = null;
$errMsg = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        'email' => FILTER_SANITIZE_SPECIAL_CHARS,
        'phone' => FILTER_SANITIZE_SPECIAL_CHARS,
        'zip' => FILTER_SANITIZE_SPECIAL_CHARS,
        'website' => FILTER_SANITIZE_URL,
        'age' => FILTER_SANITIZE_SPECIAL_CHARS,
        'product_code' => FILTER_SANITIZE_SPECIAL_CHARS,
        'message' => FILTER_UNSAFE_RAW,
    ];

    $raw = [];
    foreach ($fields as $field => $filter) {
        $value = filter_input(INPUT_POST, $field, $filter);
        $raw[$field] = $value === null ? '' : $value;
    }
    try {
        $result = validateContact($raw);
    } catch (FormatException $e) {
        $errMsg = $e->getMessage();
    } catch (ValidationException $e) {
        $errMsg = $e->getMessage();
    } catch (RuntimeException $e) {
        $errMsg = 'System error: ' . $e->getMessage();
    } finally {
        // runs regardless — good for logging
        $now = new DateTime('now', new DateTimeZone('America/Chicago'));
        error_log('Contact form processed at ' . $now->format('Y-m-d H:i:s'));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CS2623 SSP07 Ex 15-1: Chamney</title>
        <link rel="stylesheet" href="../../CSS/main.css">
        <link rel="stylesheet" href="../../CSS/table.css">
    </head>
    <body>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_header.php"; ?>
        <div id="page-wrapper">
            <nav id="left-nav">
                <ul>
                    <li><a href="../SSP07_11_1/index.php">Array operations</a></li>
                    <li>
                        <a href="../SSP07_15_1/index.php">Regex and exception handling</a>
                    </li>
                </ul>
            </nav>
            <main class="with-left-nav center-text">
                <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_topNav.php"; ?>
                <h1>Contact Form Validation</h1>
                <?php if ($errMsg) : ?>
                <div class="error">
                    <?= htmlspecialchars($errMsg, ENT_QUOTES, 'UTF-8') ?>
                </div>
                <?php endif; ?>
                <?php if ($result) : ?>
                <p>✓ All fields valid — ready to save.</p>
                <ul>
                    <li>Email: <?= htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8') ?></li>
                    <li>Phone: <?= htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8') ?></li>
                    <li>ZIP: <?= htmlspecialchars($result['zip'], ENT_QUOTES, 'UTF-8') ?></li>
                    <li>Website: <?= htmlspecialchars($result['website'], ENT_QUOTES, 'UTF-8') ?></li>
                    <li>Age: <?= (int) $result['age'] ?></li>
                    <li>Product Code: <?= htmlspecialchars($result['product_code'], ENT_QUOTES, 'UTF-8') ?></li>
                </ul>
                <p><strong>Message:</strong><br>
                    <?= nl2br(htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8')) ?>
                </p>        
                <?php endif; ?>
                <form method="post">
                    <label>Email: <input type="text" name="email"></label><br>
                    <label>Phone (555-555-5555): <input type="text" name="phone"></label><br>
                    <label>ZIP: <input type="text" name="zip"></label><br>
                    <label>Website: <input type="text" name="website"></label><br>
                    <label>Age (1-120): <input type="number" name="age" min="1" max="120"></label><br>
                    <label>Product Code (AB1234): <input type="text" name="product_code"></label><br>
                    <label>Message:<br>
                        <textarea name="message" rows="4" cols="40"></textarea>
                    </label><br>
                    <button type="submit">Validate</button>
                </form>
            </main>
        </div>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_footer.php"; ?>
    </body>
</html>
