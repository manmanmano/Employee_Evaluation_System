<?php
function checkCsv($handle, $token) {
    $csvTokens = array();
    $csvLine = explode(PHP_EOL, file_get_contents('../usersData/users.csv'));
    foreach ($csvLine as $line) {
        $values = explode(';', $line);
        array_push($csvTokens, $values[4]);

    }
    if (!in_array($token, $csvTokens)) {
        exit ("Token doesn't exist");
  }

?>
