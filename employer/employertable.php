<?php
function createNames() {
    $csvfile = fopen("Eval.csv", "r");
    $names = array();
    while ($data = fgetcsv($csvfile, 1000, ";")) {
        if (!in_array($data[0], $names)) {
            array_push($names, $data[0]);
        }
    }
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

function createTable() {
    $csvfile = fopen("Eval.csv", "r");
    $names = array();
    $employees = array();
    while ($data = fgetcsv($csvfile)) {
        if (!in_array($data[0], $names)) {
            array_push($names, $data[0]);
        }
    }
    foreach ($name as $names) {
        $evaluations = array();
        while ($data = fgetcsv($csvfile)) {
            if ($name == $data[0]) {
                $evaluations[$data[1]] = $data[2];
            }
        }
        $employees[$name] = $evaluations;
    }
    print_r($employees);
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
