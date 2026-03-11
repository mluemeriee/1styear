<?php
$text = " Hello World! ";
$sentence = "PHP is fun to learn";

echo "Length of text: " . strlen($text) . "<br>";

echo "Lowercase: " . strtolower($text) . "<br>";

echo "Uppercase: " . strtoupper($text) . "<br>";

echo "Position of 'World': " . strpos($text, "World") . "<br>";

echo "Substring (6,5): " . substr($text, 6,5) . "<br>";

echo "Trimmed text: " . trim($text) . "<br>";

$words = explode(" ", $sentence);
echo "Exploded array:";
print_r($words);
echo "<br>";

$joined = implode("-", $words);
echo "Imploded string:" . $joined . "<br>";
?>