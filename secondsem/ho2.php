<?php
    $words = ["", "", "",""];

    function data($array) {
        echo "<h2>Original&Processed Words</h2>";
        foreach ($array as $index => $value) {
            echo "Original " . ($index + 1) . ": " . htmlspecialchars ($value) . "<br>";
        }
    }

    function step2($result){
        if ($words = strrev ($words[$i])){
            return "Processed" . $result;
        }
    }
$result = strrev ($words);
echo step2($result);

if($SERVER["REQUEST_METHOD"]=="POST"){
    for($i = 0; $i < 4; $i++){
        if ($_POST["data . $i"]) {
            $words[$i]=trim($POST["data. $i"]);
        } else {
            $words[$i]= "error";
        }
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <title>Fruits</title>
</head>
<body>
    
    <form method="post" action="">
        Word 1: <input type="words" name="w1"> <br><br>
        Word 2: <input type="words" name="w2"> <br><br>
        Word 3: <input type="words" name="w3"> <br><br>
        Word 4: <input type="words" name="w4"> <br><br>
        <input type="submit" value="check">
    </form>
<?
    if ($SERVER["REQUEST_METHOD"]=="POST"){
        data($words);
    }
?>
</body>
</html>
