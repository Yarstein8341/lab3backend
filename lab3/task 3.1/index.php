<?php
$file_path = 'comments.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    if (!empty($name) && !empty($comment)) {
        $file = fopen($file_path, 'a');
        fwrite($file, $name . "\n" . $comment . "\n");
        fclose($file);
    }
}

$comments = [];
if (file_exists($file_path)) {
    $file = fopen($file_path, 'r');
    while (!feof($file)) {
        $name = fgets($file);
        $comment = fgets($file);
        if (!empty($name) && !empty($comment)) {
            $comments[] = ['name' => $name, 'comment' => $comment];
        }
    }
    fclose($file);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книга відгуків</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Залиште свій відгук</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Ім’я:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="comment">Коментар:</label><br>
    <textarea id="comment" name="comment" rows="4" required></textarea><br><br>
    <input type="submit" value="Надіслати">
</form>

<?php if (!empty($comments)) : ?>
    <h2>Поточні коментарі</h2>
    <table>
        <tr>
            <th>Ім'я</th>
            <th>Коментар</th>
        </tr>
        <?php foreach ($comments as $comment) : ?>
            <tr>
                <td><?php echo $comment['name']; ?></td>
                <td><?php echo $comment['comment']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
