<?php
function createTable() {
    $grades = array();
    $csvfile = fopen("Eval.csv", "r");
    while ($data = fgetcsv($csvfile, 1000, ";")) {
        print_r($data);
        if ($data[0] == $_SESSION['name']) {
            $grades[$data[1]] = $data[2];
        }
    }
    fclose($csvfile);
    $week = intval(date("W", strtotime($_POST['date'])));
    if (isset($_POST['search']) && !empty($_POST['date'])) {
        $month = intval(date("m", strtotime($_POST['date'])));
        $day = intval(date("d", strtotime($_POST['date'])));
        $year = intval(date("y", strtotime($_POST['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        echo "<tr>";
        echo "<td>", $week, "<td>";
        echo "<td class='evals'>", $grades[$week], "</td>";
        echo "</tr>";
    } else {
        foreach ($grades as $week => $grade) {
            echo "<tr>";
            echo "<td>", $week, "</td>";
            echo "<td class='evals'>", $grade,"</td>";
            echo "</tr>";
        }
    }
}
?>
