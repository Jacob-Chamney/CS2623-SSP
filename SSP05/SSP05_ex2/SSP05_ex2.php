<?php

//declare(strict_types=1); not introduced until PHP 7.0, so not using it here.
// I know it said to ignore this in the recent email, but i like a challenge.
// Running into this also makes me have to read docs more which is good practice
// for a junior dev. Its a valuable skill to have.

// Also side note, PHP2Shell was discovered and i couldn't help but think
// to myself "Perfect timing to be taking a PHP class"

require_once dirname(dirname(__DIR__)) . "/PHP/functions.php";

$method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
if (is_null($method)) {
    $method = 'GET';
}

if ($method === 'POST') {
    // Read and validate form data
    // ?? is not available until PHP 7.0, so the null checks are done below
    $cust_name = filter_input(INPUT_POST, 'cust_name');
    $product = filter_input(INPUT_POST, 'product');
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
    $payment = filter_input(INPUT_POST, 'payment');
    $instructions = filter_input(INPUT_POST, 'instructions');

    // checkbox array, FILTER_REQUIRE_ARRAY is required for options[]
    // use FILTER_UNSAFE_RAW so no filtering happens, FILTER_DEFAULT is deprecated in PHP 8.5
    $options = filter_input(INPUT_POST, 'options', FILTER_UNSAFE_RAW, FILTER_REQUIRE_ARRAY);
    // why does the above line work?
    // The above line works because it uses the `filter_input` function to retrieve the values
    // of the 'options' input field from the POST request. The `FILTER_UNSAFE_RAW` filter is used
    //  to get the raw data without any filtering, and `FILTER_REQUIRE_ARRAY` indicates that the
    //  input is expected to be an array (which is the case for checkboxes with the same name).
    //  This allows you to capture all selected options in an array format.
    if (is_null($cust_name)) {
        $cust_name = '';
    }
    if (is_null($product)) {
        $product = '';
    }
    if (is_null($quantity)) {
        $quantity = 1;
    }
    if (is_null($payment)) {
        $payment = 'none';
    }
    if (is_null($instructions)) {
        $instructions = '';
    }
    if (is_null($options)) {
        $options = array();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2623 SSP05: Chamney</title>
    <link rel="stylesheet" href="../../CSS/main.css">
</head>
<body>
    <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_header.php"; ?>
    <div id="page-wrapper">
        <nav id="left-nav">
            <ul>
                <li><a href="../../SSP05/SSP05_ex1/SSP05_ex1.php">Personal Info Exercise</a></li>
                <li><a href="../../SSP05/SSP05_ex2/SSP05_ex2.php">Product Order Exercise</a></li>
            </ul>
        </nav>
        <main class="with-left-nav">
            <nav id="top-nav">
                <a href="../../SSP01/index.php">Home</a>
                <a href="../../SSP02/SSP02.php">SSP02</a>
                <a href="../../SSP03/SSP03.php">SSP03</a>
                <a href="../../SSP04/ex1.php">SSP04</a>
                <a href="../../SSP05/SSP05.html">SSP05</a>
                <a href="../../SSP06/SSP06.php">SSP06</a>
                <a href="../../SSP07/SSP07.html">SSP07</a>
                <a href="../../SSP08/SSP08.php">SSP08</a>
                <a href="../../SSP09/SSP09.php">SSP09</a>
                <a href="../../SSP10/SSP10.php">SSP10</a>
                <a href="../../SSP11/SSP11.php">SSP11</a>
                <a href="../../SSP12/SSP12.php">SSP12</a>
            </nav>
            <h1 class="center-text">Product Order</h1>
            <form method="POST">
                <label for="cust_name">Customer Name:</label>
                <input type="text" id="cust_name" name="cust_name" required>
                <br>
                <label for="product">Product:</label>
                <select id="product" name="product" required>
                    <option value="">Select a product</option>
                    <option value="Notebook">Notebook ($12.50)</option>
                    <option value="Pen Set">Pen Set ($8.75)</option>
                    <option value="Desk Lamp">Desk Lamp ($34.00)</option>
                    <option value="Backpack">Backpack ($49.99)</option>
                </select><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1"
                    value="1" required><br>
                <label>Options:</label>
                <input type="checkbox" id="gift_wrap" name="options[]"
                    value="gift_wrap">
                <label for="gift_wrap">Gift wrap ($4.50)</label><br>
                <input type="checkbox" id="express_ship" name="options[]"
                    value="express_ship">
                <label for="express_ship">Express shipping ($12.00)</label><br>
                <input type="checkbox" id="insurance" name="options[]"
                    value="insurance">
                <label for="insurance">Shipping insurance ($6.25)</label><br>

                <label>Payment Method:</label>
                <input type="radio" id="credit" name="payment" value="credit"
                    checked>
                <label for="credit">Credit</label>
                <input type="radio" id="debit" name="payment" value="debit">
                <label for="debit">Debit</label>
                <input type="radio" id="paypal" name="payment" value="paypal">
                <label for="paypal">PayPal</label><br>
                <label for="instructions">Special Instructions:</label><br>
                <textarea id="instructions" name="instructions" rows="4"
                    cols="50"></textarea><br>
                <input type="submit" value="Place Order">
            </form>
            <?php if ($method === 'POST') : ?>
                <h2>Order Summary</h2>
                <p><strong>Customer:</strong>
                    <?php e($cust_name); ?></p>
                <p><strong>Product:</strong>
                    <?php e($product); ?></p>
                <p><strong>Quantity:</strong>
                    <?php e((string)$quantity); ?></p>
                <p><strong>Payment:</strong>
                    <?php e($payment); ?></p>
                <p><strong>Selected Options:</strong></p>
                <ul>
                    <?php foreach ($options as $opt) : ?>
                        <li><?php e($opt); ?></li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Instructions:</strong><br>
                    <?php echo nl2br(htmlspecialchars($instructions, ENT_QUOTES, 'UTF-8')); ?></p>
            <?php endif; ?>
        </main>
    </div>
    <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_footer.php"; ?>
</body>
</html>
