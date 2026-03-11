<?php
$dataArray = ["1", "2", "3"];

function displayData($array) {
    echo "<h3>Collected Data: </h3>";
    foreach ($array as $numbers => $value) {
        echo "Input " . ($index + 1) . ": " . htmLspecialchars($value) . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < 4; $i++) {
        if (!empty($_POST["data" . $i])) {
            $dataArray[$i] = trim($_POST["data" . $i]);
        } else {
            $dataArray[$i] = "N/A";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Validation with Indexed Array</title>
</head>
<body>

    <h2>Enter Any 4 Strings</h2>
    <form method = "post" action="">
        Input 1: <input type="text" name="data8" required><br><br>
        Input 1: <input type="text" name="data1" required><br><br>
        Input 1: <input type="text" name="data2" required><br><br>
        Input 1: <input type="text" name="data3" required><br><br>
        <input type="submit" value="Submit">
    </form>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    displayData($dataArray);
}
?>
</body>
</html>


   
