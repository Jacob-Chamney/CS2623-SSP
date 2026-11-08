<?php

declare(strict_types=1);

session_start();

$_SESSION['attempts'] ??= 0;
$_SESSION['locked'] ??= false;
$rememberedUser = (string) ($_COOKIE['remember_user'] ?? '');

$users = [
    'admin' => password_hash('secret123', PASSWORD_DEFAULT),
    'jsmith' => password_hash('php4life!', PASSWORD_DEFAULT),
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = (string) (filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '');
    $password = (string) (filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW) ?? '');

    if ($_SESSION['locked']) {
        $error = 'Too many failed attempts. Account locked for this session.';
    } elseif (isset($users[$username]) && password_verify($password, $users[$username])) {
        session_regenerate_id(true);
        $_SESSION['user'] = $username;
        $_SESSION['login_at'] = time();
        $_SESSION['attempts'] = 0;
        $_SESSION['locked'] = false;
        if (isset($_POST['remember'])) {
            setcookie('remember_user', $username, [
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        } else {
            setcookie('remember_user', '', [
                'expires' => time() - 3600,
                'path' => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        }
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['attempts']++;

        if ($_SESSION['attempts'] >= 3) {
            $_SESSION['locked'] = true;
            $error = 'Too many failed attempts. Account locked for this session.';
        } else {
            $remaining = 3 - $_SESSION['attempts'];
            $error = "Invalid username or password. {$remaining} attempt(s) remaining.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CS2623 Login</title>
    </head>
    <body>
        <h1>Login</h1>

        <?php if ($error !== '') : ?>
        <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form method="post">
            <label>Username:
                <input type="text" name="username" autocomplete="username"
                    value="<?= htmlspecialchars($username ?? $rememberedUser, ENT_QUOTES, 'UTF-8') ?>">
            </label><br>
            <label>Password:
                <input type="password" name="password" autocomplete="current-password">
            </label><br>
            <label>
                <input type="checkbox" name="remember" value="1"
                    <?= $rememberedUser !== '' ? 'checked' : '' ?>>
                Remember me
            </label><br>
            <button type="submit">Log in</button>
        </form>
    </body>
</html>
