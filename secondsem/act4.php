<?php
    $numbers = ["", "", ""];
    function calculateVariable($values) {
        echo "<h2>Entered Numbers </h2><br>";
        foreach ($values as $index => $value) {
            echo "Number " . ($index + 1) . ": " . "$value <br>";
        }
        $avg = array_sum($values) / 3;
        echo "<h3>Average: " . $avg . "</h3>";
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        for ($i = 0; $i < 3; $i++) {
            if (!empty($_POST["num" . $i])) {
                $values[$i] = trim($_POST["num" . $i]);
            } else {
                $values[$i] = "No Value";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Numbers</title>
</head>
<body>
    <h2>Enter 3 Numbers</h2>
    <form method="post" action="">
        Number 1: <input type="number" name="num0"> <br><br>
        Number 2: <input type="number" name="num1"> <br><br>
        Number 3: <input type="number" name="num2"> <br><br>
        <input type="submit" value="Submit">
    </form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        calculateVariable($values);
    }
?>
</body>
</html>