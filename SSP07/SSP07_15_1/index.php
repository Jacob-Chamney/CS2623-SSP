<?php

declare(strict_types=1);

use CS2623\Week4\ValidationException;

require_once dirname(dirname(__DIR__)) . "/PHP/functions.php";
require_once __DIR__ . "/DatabaseException.php";
require_once __DIR__ . "/ValidationException.php";

$result = null;
$errMsg = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = [
        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS)
            ?? '',
        'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS)
            ?? '',
        'zip' => filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_SPECIAL_CHARS)
            ?? '',
        'notes' => filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_SPECIAL_CHARS)
            ?? '',
    ];
    try {
        $result = validateContact($raw);
    } catch (ValidationException $e) { // specific first
        $errMsg = $e->getMessage();
    } catch (RuntimeException $e) { // broader next
        $errMsg = 'System error: ' . $e->getMessage();
    } finally {
        // runs regardless — good for logging
        error_log('Contact form processed at ' . date('Y-m-d H:i:s'));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head><meta charset="UTF-8"><title>Ex 15-1 Validation</title></head>
    <body>
        <h1>Contact Form Validation</h1>
        <?php if ($errMsg) : ?>
        <div class="error">
            <?= htmlspecialchars($errMsg, ENT_QUOTES, 'UTF-8') ?>
        </div>
        <?php endif; ?>
        <?php if ($result) : ?>
        <p>✓ All fields valid — ready to save.</p>
        <ul>
            <li>Email: <?= htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8')
            ?></li>
            <li>Phone: <?= htmlspecialchars($result['phone'], ENT_QUOTES, 'UTF-8')
            ?></li>
            <li>ZIP: <?= htmlspecialchars($result['zip'], ENT_QUOTES, 'UTF-8')
            ?></li>
        </ul>
        <?php endif; ?>
        <form method="post">
            <label>Email: <input type="text" name="email"></label><br>
            <label>Phone (555-555-5555): <input type="text" name="phone"></label><br>
            <label>ZIP: <input type="text" name="zip"></label><br>
            <label>Notes:<br>
                <textarea name="notes" rows="4" cols="40"></textarea>
            </label><br>
            <button type="submit">Validate</button>
        </form>
    </body></html>
