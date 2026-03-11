<?php
function calculatePercentage ($total, $part) {
    if ($total==0) {
        return "Total cannot be zero";
    }
    return ($part / $total)*100;
    }

    $result = calculatePercentage (200, 50);
    echo "The percentage is: " . $result . "%";
?>