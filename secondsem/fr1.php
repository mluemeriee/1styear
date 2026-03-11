<!DOCTYPE html>
<html>
<head>
    <title>Meow</title>
</head>
<body>

<form method="post">
    <strong>Name:</strong> <input type="text" name="name" required> <br><br>
    <strong>Age:</strong> <input type="number" name="age" required> <br><br>
    <strong>Favorite Color:</strong> <input type="text" name="fc" required><br><br>
    <strong>A Number:</strong> <input type="number" name="n" required> <br><br>
    <input type="submit" value="Submit"> <br><br>
</form>

</body>
</html>

<?php

    
    function formatName($name) {
        return "<strong>Name: </strong>" . ucwords(strtolower($name)) . "<br>";
    } 

   
    function ageCat($age) {
        if ($age < 18 && $age > 0) {
            $cat = "Minor";
        } elseif ($age < 60 && $age >= 18) {
            $cat = "Adult";
        } elseif ($age >= 60) {
            $cat = "Senior";
        } else {
            $age = "Please enter a valid age!";
            $cat = "NULL";
        }
        return "<strong>Age:</strong> $age (Category: $cat) <br>";
    }

   
    function revColor($c) {
        return "<strong>Favorite Color (Reversed): </strong>" . strrev($c) . "<br>";
    }

    //Output Display
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $fc = $_POST['fc'];
        $num = $_POST['n'];
    
        echo "<h4>Processed Data:</h4>";
        echo formatName($name);
        echo ageCat($age);
        echo revColor($fc);
        echo "<strong>Entered Number:</strong> $num";    
}
?>