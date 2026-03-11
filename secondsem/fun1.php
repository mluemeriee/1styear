<form method="post">
    Num1: <input type="number" name="n1"> <br>
    Num2: <input type="number" name="n2"> <br>
    <input type="submit" value="Submit">
</form>
<?php
function addIfGreaterThanTen($num1, $num2) {
    if ($num1 > $num2) {
        return $num1 + $num2;
    } else {
        return "Addition Skipped: The number is not greater than the second.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $num1 = $_POST['n1'];
    $num2 = $_POST['n2'];
    
    echo addIfGreaterThanTen($num1, $num2) . "<br>";
}
?>