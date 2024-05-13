<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $user_directory = "users/" . $login . "/";

    if (file_exists($user_directory)) {
        $result = deleteFolder($user_directory);
        if ($result) {
            echo "Папка для користувача '" . $login . "' успішно видалена.";
        } else {
            echo "Помилка: неможливо видалити папку для користувача '" . $login . "'.";
        }
    } else {
        echo "Помилка: Папка для користувача '" . $login . "' не існує.";
    }
}

function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        return false;
    }
    $files = array_diff(scandir($folderPath), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$folderPath/$file")) ? deleteFolder("$folderPath/$file") : unlink("$folderPath/$file");
    }
    return rmdir($folderPath);
}
?>
