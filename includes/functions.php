<?php

// count lines in file
function readLogs($file) {
    $lines = 0;
    $handle = fopen($file, "r");
    while (!feof($handle)) {
        $line = fgets($handle);
        $lines++;
    }
    fclose($handle);
    return $lines;
}

?>