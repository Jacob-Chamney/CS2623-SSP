<?php

declare(strict_types=1);

require_once dirname(dirname(__DIR__)) . "/PHP/functions.php";

$navBase = '../../';

$fruits = ['apple', 'banana', 'cherry', 'dragonfruit'];
$search = (string) (filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '');
$action = (string) (filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?? '');

$message = '';
$showSorted = false;
$sortedFruits = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'sort') {
        $sortedFruits = $fruits;
        sort($sortedFruits);
        $showSorted = true;
    } elseif ($search !== '') {
        if (!preg_match('/^[a-zA-Z]+$/', $search)) {
            $error = "Invalid input: only letters are allowed.";
        } else {
            $found = in_array($search, $fruits, true);
            $message = $found ? "✓ Found: $search" : "✗ Not found: $search";
        }
    }
}

// array_map with arrow function (PHP 7.4+)
$upper = array_map(fn($f) => strtoupper($f), $fruits);

$longFruits = array_filter($fruits, fn($f) => strlen($f) >= 6);

// arrays of arrays — simulates a DB result set
$catalog = [
    ['id' => 1, 'name' => 'Apple', 'price' => 1.29],
    ['id' => 2, 'name' => 'Banana', 'price' => 0.49],
    ['id' => 3, 'name' => 'Cherry', 'price' => 2.99],
    ['id' => 4, 'name' => 'Dragonfruit', 'price' => 4.99],
];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CS2623 SSP07 Ex 11-1: Chamney</title>
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
                <h1>Fruit Array Demo</h1>
                <form method="post">
                    <label>Search fruit:
                        <input type="text" name="search"
                            value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">
                    </label>
                    <button type="submit" name="action" value="search">Search</button>
                    <button type="submit" name="action" value="sort">Sort A→Z</button>
                </form>
                <?php if ($error !== '') : ?>
                <div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>
                <?php if ($message) : ?>
                <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <h2>Original List (<?= count($fruits) ?> items)</h2>
                <ul>
                    <?php foreach ($fruits as $f) : ?>
                    <li><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
                <h2>Fruits 6+ Characters (<?= count($longFruits) ?> items)</h2>
                <ul>
                    <?php foreach ($longFruits as $f) : ?>
                    <li><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($showSorted) : ?>
                <h2>Sorted A→Z</h2>
                <ul>
                    <?php foreach ($sortedFruits as $f) : ?>
                    <li><?= htmlspecialchars($f, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <h2>Uppercase (array_map + arrow fn)</h2>
                <ul>
                    <?php foreach ($upper as $u) : ?>
                    <li><?= htmlspecialchars($u, ENT_QUOTES, 'UTF-8') ?></li>
                    <?php endforeach; ?>
                </ul>
                <h2>Catalog (array of arrays)</h2>
                <table class="data-table">
                    <tr><th>ID</th><th>Name</th><th>Price</th></tr>
                    <?php foreach ($catalog as $row) : ?>
                    <tr>
                        <td><?= (int)$row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>$<?= number_format((float)$row['price'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </main>
        </div>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_footer.php"; ?>
    </body>
</html>
