<?php
function createNames() {
    $csvfile = fopen("Eval.csv", "r");
    $names = array();
    for ($i = 0, $array = array(); !feof($csvfile); $i++) {
        $array = fgetcsv($csvfile);
        $names[$i] = $array[0];
    }
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

function createTable() {
    $csvfile = fopen("Eval.csv", "r");
    $employees = array();
    $names = array();
    for ($i = 0, $array = array(); !feof($csvfile); $i++) {
        $array = fgetcsv($csvfile);
        if (!in_array($array[0], $names)) {
            $names[$i] = $array[0];
        }
    }
    foreach ($name as $names) {
        $evaluations = array();
        for ($i = 0, $array = array(); !feof($csvfile); $i++) {
            $array = fgetcsv($csvfile);
            if ($name == $array[0]) {
                $evaluations[$array[1]] = $array[2];
            }
        }
        $employees[$name] = $evaluations;
    }
    if (isset($_POST['search']) && !empty($_POST['date']) && empty($_POST['name'])) {
        $week = intval(date("W", strtotime($_POST['date'])));
        $month = intval(date("m", strtotime($_POST['date'])));
        $day = intval(date("d", strtotime($_POST['date'])));
        $year = intval(date("y", strtotime($_POST['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        foreach ($employees as $name => $grades) {
            if (!empty($grades[$week])) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td class='evals'>", $grades[$week], "</td>";
                echo "</tr>";
            }
        }
    } elseif (isset($_POST['search']) && empty($_POST['date']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
        foreach ($employees[$name] as $week => $grade) {
            echo "<tr>";
            echo "<td>", $name, "</td>";
            echo "<td>", $week, "</td>";
            echo "<td class='evals'>", $grade, "</td>";
            echo "</tr>";
        }
    } elseif (isset($_POST['search']) && !empty($_POST['date']) && !empty($_POST['name'])) {
        $week = intval(date("W", strtotime($_POST['date'])));
        $month = intval(date("m", strtotime($_POST['date'])));
        $day = intval(date("d", strtotime($_POST['date'])));
        $year = intval(date("y", strtotime($_POST['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        $name = $_POST['name'];
        echo "<tr>";
        echo "<td>", $name, "</td>";
        echo "<td>", $week, "</td>";
        echo "<td>", $employees[$name][$week], "</td>";
        echo "</tr>";
    } else {
        foreach ($employees as $name => $grades) {
            foreach ($grades as $week => $grade) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td class='evals'>", $grade, "</td>";
                echo "</tr>";
            }
        }
    }
}

?>
