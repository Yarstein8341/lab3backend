<?php

$file_content = file_get_contents('words.txt');
$words = explode(" ", $file_content);

$words = array_map('trim', $words);

sort($words, SORT_LOCALE_STRING);

foreach ($words as $word) {
    echo $word . "\n";
}
?>
