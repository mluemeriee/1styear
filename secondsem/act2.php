<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
</head>
<body>

<h2>Body Mass Index Calculator</h2>

<form method="post">
    <label>Enter Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Enter Weight (kg):</label>
    <input type="number" name="weight" step="0.01" required><br><br>

    <label>Enter Height (meters):</label>
    <input type="number" name="height" step="0.01" required><br><br>

    <input type="submit" name="submit" value="Calculate BMI">
</form>

<?php
class BMI {
    public $name;
    public $bmi;

    public function setName($name) {
        $this->name = $name;
    }

    public function calculateBMI($weight, $height) {
        $this->bmi = $weight / ($height * $height);
    }

    public function displayInfo() {
        echo "<h3> BMI Result:</h3>";
        echo "Name: " . $this->name . "<br>";
        echo "BMI: " . number_format($this->bmi, 2) . "<br>";

        if ($this->bmi < 18.5) {
            echo "Category: Underweight";
        } elseif ($this->bmi >= 18.5 && $this->bmi <= 24.9) {
            echo "Category: Normal weight";
        } elseif ($this->bmi >= 25 && $this->bmi <= 29.9) {
            echo "Category: Overweight";
        } else {
            echo "Category: Obese";
        }
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    $bmiCalculator = new BMI();

    $bmiCalculator->setName($name);
    $bmiCalculator->calculateBMI($weight, $height);
    $bmiCalculator->displayInfo();
}
?>
</body>
</html>

