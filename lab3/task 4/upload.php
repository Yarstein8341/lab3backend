<?php
$upload_directory = "uploads/";

if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0){
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];

    if(move_uploaded_file($file_tmp, $upload_directory . $file_name)){
        echo "Файл завантажено успішно.";
    } else{
        echo "Помилка завантаження файлу.";
    }
} else{
    echo "Будь ласка, додайте файл для завантаження.";
}
?>
