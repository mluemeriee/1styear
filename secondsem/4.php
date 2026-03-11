<!DOCTYPE html>
<html>
    <head>
        <title>Simple PHP OOP Form Handling</title>
</head>
<body>

<form method="post">
    <label>Enter Name:</lable>
    <input type="text" name="name" required><br><br>

    <label>Enter Birth Year:</label>
    <input type="number": name="birthYear" required><br><br>

    <input type="submit": name="submit" value="Submit">
</form>

<?php
class Person {
    public $name;
    public $age;

    public function setName($name) {
        $this->name =$name;
    }
    public function calculateAge($birthYear) {
        $currentYear = 2025;
        $this->age = $currentYear-$birthYear;
}
    public function displayInfo() {
        echo "<h3>Person Information:</h3>";
        echo "Name: " . $this->name . "<br>";
        echo "Age: " . $this->age . "<br>";

        if ($this->age<18) {
            echo "Category: Minor";
        } else {
            echo "Category: Adult";
        }
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $birthYear = $_POST['birthYear'];

    $person = new Person();

    $person->setName($name);
    $person->calculateAge($birthYear);
    $person->displayInfo();
}
?>
</body>
</html>
