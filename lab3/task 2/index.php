<?php
session_start();

// Перевіряємо, чи була надіслана форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Перевірка логіна та пароля
    $login = isset($_POST['login']) ? $_POST['login'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if ($login === 'Admin' && $password === 'password') {
        $_SESSION['authenticated'] = true;
        $_SESSION['username'] = 'Admin';
    } else {
        $error = "Невірний логін або пароль";
    }
}

// Вихід з сесії при натисканні кнопки "Вийти з форми"
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    // Очищення змінної $error
    unset($error);
}

// Перевіряємо, чи користувач вже авторизований
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    $message = "Добрий день, " . $_SESSION['username'] . "!";
} else {
    $message = isset($error) ? $error : "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизація</title>
</head>
<body>

<?php if (isset($message)) : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<?php if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) : ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login">Логін:</label><br>
        <input type="text" id="login" name="login"><br>
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Увійти">
    </form>
<?php endif; ?>

<?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) : ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Вийти з форми">
    </form>
<?php endif; ?>

</body>
</html>
