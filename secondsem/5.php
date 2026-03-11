<?php
$queue= new SplQueue();

$names = ["John", "Anna", "Peter123"];

foreach ($names as $name) {
    if (preg_match("/^[a-zA-Z\s]+$/", $name)) {
    $queue->enqueue($name);
    echo "Added to queue: $name\n<br><br>";
} else {
    echo "Invalid name: $name\n<br><br>";
}
}

if (!$queue->isEmpty()){
    echo "\nNames in the queue:\n<br>";
    foreach ($queue as $name) {
        echo "-$name\n<br>";
}
        echo "\nProcessing names:\n<br>";
        while (!$queue->isEmpty()){
        $processedName = $queue->dequeue();
        echo "Processed: $processedName\n<br>";
}
} else {
    echo "\nNo valid names to process \n<br>";
}
?>