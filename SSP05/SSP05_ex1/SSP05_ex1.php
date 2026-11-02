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
    $first = filter_input(INPUT_POST, 'first_name');
    $last = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
    $gender = filter_input(INPUT_POST, 'gender');
    $country = filter_input(INPUT_POST, 'country');
    $comments = filter_input(INPUT_POST, 'comments');

    if (is_null($first)) {
        $first = '';
    }
    if (is_null($last)) {
        $last = '';
    }
    if (is_null($email)) {
        $email = '';
    }
    if (is_null($age)) {
        $age = 0;
    }
    if (is_null($gender)) {
        $gender = 'not specified';
    }
    if (is_null($country)) {
        $country = '';
    }
    if (is_null($comments)) {
        $comments = '';
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
                <a href="../../SSP07/SSP07.php">SSP07</a>
                <a href="../../SSP08/SSP08.php">SSP08</a>
                <a href="../../SSP09/SSP09.php">SSP09</a>
                <a href="../../SSP10/SSP10.php">SSP10</a>
                <a href="../../SSP11/SSP11.php">SSP11</a>
                <a href="../../SSP12/SSP12.php">SSP12</a>
            </nav>
            <h1 class="center-text">Personal Information</h1>
            <form method="POST">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="0"
                    required><br>
                <label>Gender:</label>
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label>
                <input type="radio" id="other" name="gender" value="other">
                <label for="other">Other</label><br>
                <label for="country">Country:</label>
                <select id="country" name="country" required>
                    <option value="">Select a country</option>
                    <option value="USA">USA</option>
                    <option value="Canada">Canada</option>
                    <option value="UK">UK</option>
                    <option value="Australia">Australia</option>
                    <option value="Germany">Germany</option>
                </select><br>
                <label for="comments">Comments:</label><br>
                <textarea id="comments" name="comments" rows="4"
                    cols="50"></textarea><br>
                <input type="submit" value="Submit">
            </form>
            <?php if ($method === 'POST') : ?>
                <h2>Submitted Information</h2>
                <p><strong>Name:</strong>
                    <?php e($first . ' ' . $last); ?></p>
                <p><strong>Email:</strong>
                    <?php e($email ?: '(invalid)'); ?></p>
                <p><strong>Age:</strong>
                    <?php e((string)$age); ?></p>
                <p><strong>Gender:</strong>
                    <?php e($gender); ?></p>
                <p><strong>Country:</strong>
                    <?php e($country); ?></p>
                <p><strong>Comments:</strong><br>
                    <?php echo nl2br(htmlspecialchars($comments, ENT_QUOTES, 'UTF-8')); ?></p>
            <?php endif; ?>
        </main>
    </div>
    <?php require_once dirname(dirname(__DIR__)) . "/PHP/include_footer.php"; ?>
</body>

</html>
