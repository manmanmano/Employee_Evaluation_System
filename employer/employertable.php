<?php
function createNames() {
    $names = ['John Smith', 'Mary Jane', 'James Doe'];
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

function createTable() {
    $employees = array(
        'John Smith' => array(5 => 4.5, 6 => 3.9, 7 => 2.9),
        'Mary Jane' => array(5 => 3.7, 6 => 4.3, 7 => 4.4),
        'James Doe' => array(5 => 2.5, 6 => 3.5, 7 => 4.9),
    );
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
