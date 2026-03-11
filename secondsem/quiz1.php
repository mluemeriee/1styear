<?php
    function calAv($a1,$a2, $a3) {
        $res = ($a1 + $a2 + $a3) / 3 * 100;
        return "The Avarage score of $a1, $a2, and $a3 is $res";
    }
    $a1 = 81;
    $a2 = 89;
    $a3 = 93;

    echo calAv($a1, $a2, $a3);
?>