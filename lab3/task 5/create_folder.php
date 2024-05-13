<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $user_directory = "users/" . $login . "/";
    if (!file_exists($user_directory)) {
        mkdir($user_directory, 0777, true);

        mkdir($user_directory . "video");
        mkdir($user_directory . "music");
        mkdir($user_directory . "photo");

        $video_files = ["video1.mp4", "video2.mp4"];
        foreach ($video_files as $file) {
            fopen($user_directory . "video/" . $file, "w");
        }

        $music_files = ["music1.mp3", "music2.mp3"];
        foreach ($music_files as $file) {
            fopen($user_directory . "music/" . $file, "w");
        }

        $photo_files = ["photo1.jpg", "photo2.jpg"];
        foreach ($photo_files as $file) {
            fopen($user_directory . "photo/" . $file, "w");
        }

        echo "Папка для користувача '" . $login . "' успішно створена.";
    } else {
        echo "Помилка: Папка для користувача '" . $login . "' вже існує.";
    }
}
?>
