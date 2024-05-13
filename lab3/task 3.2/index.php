<?php

function getWordsFromFile($filename) {
    $file_content = file_get_contents($filename);
    return explode(' ', $file_content);
}

$words_file1 = getWordsFromFile('file1.txt');
$words_file2 = getWordsFromFile('file2.txt');

$unique_to_file1 = array_diff($words_file1, $words_file2);
file_put_contents('unique_to_file1.txt', implode(' ', $unique_to_file1));

$common_to_both = array_intersect($words_file1, $words_file2);
file_put_contents('common_to_both.txt', implode(' ', $common_to_both));

$words_file1_counts = array_count_values($words_file1);
$words_file2_counts = array_count_values($words_file2);
$common_twice_or_more = array_intersect_key($words_file1_counts, array_intersect_key($words_file2_counts, array_filter($words_file1_counts, function ($count) { return $count >= 2; })));
file_put_contents('common_twice_or_more.txt', implode(' ', array_keys($common_twice_or_more)));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filename_to_delete = $_POST['filename_to_delete'];
    if (file_exists($filename_to_delete)) {
        unlink($filename_to_delete);
        echo "Файл \"$filename_to_delete\" був успішно видалений.";
    } else {
        echo "Файл \"$filename_to_delete\" не знайдений.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete File</title>
</head>
<body>
    <h2>Видалення файлу</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="filename_to_delete">Введіть ім'я файлу для видалення:</label><br>
        <input type="text" id="filename_to_delete" name="filename_to_delete" required><br><br>
        <input type="submit" value="Видалити файл">
    </form>
</body>
</html>
