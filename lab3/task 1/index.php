<?php
session_start();

function setFontSize($size) {
    $_SESSION['font_size'] = $size;
}

if (isset($_GET['size'])) {
    $size = $_GET['size'];
    setFontSize($size);
} else {
    $size = $_SESSION['font_size'] ?? 'medium';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Розмір шрифту</title>
    <style>
        body {
            font-size: <?php echo $size === 'large' ? '24px' : ($size === 'medium' ? '16px' : '12px'); ?>;
        }
    </style>
</head>
<body>

<h1>Розмір шрифту</h1>

<a href="?size=large">Великий шрифт</a> |
<a href="?size=medium">Середній шрифт</a> |
<a href="?size=small">Маленький шрифт</a>

</body>
</html>
