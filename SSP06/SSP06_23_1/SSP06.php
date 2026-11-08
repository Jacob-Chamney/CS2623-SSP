<?php

declare(strict_types=1);

$navBase = '../../';
$loginPath = '../SSP06_21_2/login.php';
require '../SSP06_21_2/auth.php';

$products = [
    1 => ['id' => 1, 'name' => 'Fender Stratocaster', 'price' => 499.99],
    2 => ['id' => 2, 'name' => 'Gibson Les Paul', 'price' => 799.99],
    3 => ['id' => 3, 'name' => 'Martin D-28 Acoustic', 'price' => 1299.99],
    4 => ['id' => 4, 'name' => 'Ibanez RG550', 'price' => 299.99],
];

$_SESSION['cart'] ??= [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
    $action = (string) (filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS) ?? 'add');

    if ($id !== null && $id !== false && isset($products[$id])) {
        if ($action === 'remove') {
            $qty = $_SESSION['cart'][$id] ?? 0;

            if ($qty <= 1) {
                unset($_SESSION['cart'][$id]);
            } else {
                $_SESSION['cart'][$id] = $qty - 1;
            }
        } else {
            $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        }
    }

    header('Location: ' . basename(__FILE__));
    exit;
}

$itemCount = array_sum($_SESSION['cart']);

$total = 0.0;

foreach ($_SESSION['cart'] as $pid => $qty) {
    if (isset($products[$pid])) {
        $total += $products[$pid]['price'] * $qty;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CS2623 SSP06 Ex 23-1: Chamney</title>
        <link rel="stylesheet" href="../../CSS/main.css">
        <link rel="stylesheet" href="../../CSS/table.css">
    </head>
    <body>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_header.php"; ?>
        <div id="page-wrapper">
            <main class="center-text">
                <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_topNav.php"; ?>

                <h1>Guitar Shop — Cart (<?= (int) $itemCount ?> items)</h1>
                <p>
                    Signed in as <?= htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8') ?> |
                    <a href="../SSP06_21_2/logout.php">Log out</a>
                </p>
                <?php foreach ($products as $p) : ?>
                <div class="product">
                    <h3><?= htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p>$<?= number_format((float) $p['price'], 2) ?></p>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?= (int) $p['id'] ?>">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
                <?php endforeach; ?>
                <h2>Your Cart</h2>
                <?php if (empty($_SESSION['cart'])) : ?>
                <p>Your cart is empty.</p>
                <?php else : ?>
                <table class="data-table">
                    <thead>
                        <tr><th>Product</th><th>Qty</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $pid => $qty) : ?>
                            <?php if (isset($products[$pid])) : ?>
                        <tr>
                            <td><?= htmlspecialchars($products[$pid]['name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= (int) $qty ?></td>
                            <td>$<?= number_format((float) $products[$pid]['price'] * $qty, 2) ?></td>
                        </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="2"><strong>Total</strong></td>
                            <td><strong>$<?= number_format($total, 2) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <?php endif; ?>
            </main>
        </div>
        <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_footer.php"; ?>
    </body>
</html>
