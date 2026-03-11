<?php
    // Function 1
    function backwards($word) {
        $w = strrev($word);

        if ($w == $word) {
            return "The word is a palindrome.";
        } else {
            return "The word is not a palindrome.";
        }
    }

    // Function 2
    function calcLet($st1, $st2){
        $str1 = strlen($st1);
        $str2 = strlen($st2);

        if ($str1 > $str2) {
            return $st1 . " " . $st2;
        } else {
            return "Concatenation was skipped";
        }
    }

   

    // For Function 1
    $name = "civic";

    echo "<h2>Function 1:</h2>";
    echo "<h3>Word: " . $name . "<br><br>Output:<br>";
    echo backwards($name) . "<br></h3><br>";

    // For Function 2
    $string1 = "Heoww";
    $string2 = "World!";

    echo "<h2>Function 2:</h2>";
    echo "<h3>String 1: " . $string1 . "<br>";
    echo "String 2: " . $string2 . "<br><br>Output:<br>";
    echo calcLet($string1, $string2) . "</h3>";
?>  