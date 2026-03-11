<?php
function calcAv($scores) {
    
    $res = array_sum($scores) / 3;
    return "The average scores of provided numbers is $res";
}

$s = [82, 82, 96];
echo calcAv($s);
?>