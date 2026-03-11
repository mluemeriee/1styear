<form method="post">
 Sentence: <input type="text" name="sentence"> <br> <br>
 Word to Search: <input type="text" name="search"> <br> <br>
 Seperator for Implode: <input type="text" name="implode"> <br> <br>
 Substring Start: <input type="number" name="start"> <br> <br>
 Substring Length: <input type="number" name="length"> <br> <br>
 <input type="submit" value="Analyze">
 </form>
 
 <?php
 if ($_SERVER['REQUEST_METHOD'] === "POST") {
     $word = $_POST['search'];
     $sentence = $_POST['sentence'];
     $implode = $_POST['implode'];
     $l = $_POST['length'];
     $s = $_POST['start'];
     $ex = explode(" ", $sentence);
 
     echo "<strong>Original Sentence:</strong> $sentence <br>";
     echo "<strong>Length:</strong> " . strlen($sentence) . "<br>";
     echo "<strong>Lowercase:</strong> " . strtolower($sentence) . "<br>";
     echo "<strong>Uppercase:</strong> " . strtoupper($sentence) . "<br>";
     echo "<strong>Trimmed:</strong> '" . trim($sentence) . "'<br>";
     echo "<strong>Word '$word' found at position:</strong> " . strpos($sentence, $word) . "<br>";
     echo "<strong>Exploded Array:</strong> ";
     echo print_r($ex, true);
     echo "<br>";
     echo "<strong>Imploded with '$implode':</strong> " . implode($implode, $ex) . "<br>";
     echo "<strong>Substring from $s with the length $l:</strong> " . substr($sentence, $s, $l);
 }
 ?>