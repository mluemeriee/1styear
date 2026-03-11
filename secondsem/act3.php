<?php
$queue = new SplQueue();

function isValidName($name) {
    return preg_match("/^[a-zA-Z\s]+$/", $name);
}

$names = ["John123", "Alice", "Bob", "Sarah", "Mark1"];

foreach ($names as $name) {
    if (isValidName($name)) {
        $queue->enqueue($name);
        echo "Added to queue: $name<br>";

        if (strlen($name) == 5) {
            echo "VIP Pass: $name gets a priority seat!<br>";
        }
    } else {
        echo "Invalid name: $name<br>";
    }
}

echo "<br>Names in the queue:<br>";
foreach ($queue as $name) {
    echo "- $name<br>";
}

echo "<br>Processing visitors:<br>";
while (!$queue->isEmpty()) {
    $processedName = $queue->dequeue();
    echo "Processed: $processedName<br>";
}

echo "<br>All visitors have enjoyed the ride! Ready for the next batch.<br>";
?>

