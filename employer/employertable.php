<?php
function createOptionsNames() {
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
    if (isset($_POST['search']) && intval(substr($_POST['week'], 6, 2)) != 0 && empty($_POST['name'])) {
        $week = intval(substr($_POST['week'], 6, 2));
        foreach ($employees as $name => $grades) {
            if (!empty($grades[$week])) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td><a href='grade popup'>", $grades[$week], "</a></td>";
                echo "</tr>";
            }
        }
    } elseif (isset($_POST['search']) && intval(substr($_POST['week'], 6, 2)) == 0 && !empty($_POST['name'])) {
        $name = $_POST['name'];
        foreach ($employees[$name] as $week => $grade) {
            echo "<tr>";
            echo "<td>", $name, "</td>";
            echo "<td>", $week, "</td>";
            echo "<td><a href='grade popup'>", $grade, "</a></td>";
            echo "</tr>";
        }
    } elseif (isset($_POST['search']) && intval(substr($_POST['week'], 6, 2)) != 0 && !empty($_POST['name'])) {
        $name = $_POST['name'];
        $week = intval(substr($_POST['week'], 6, 2));
        echo "<tr>";
        echo "<td>", $name, "</td>";
        echo "<td>", $week, "</td>";
        echo "<td><a href='grade popup'>", $employees[$name][$week], "</a></td>";
        echo "</tr>";
    } else {
        foreach ($employees as $name => $grades) {
            foreach ($grades as $week => $grade) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td><a href='grade popup'>", $grade, "</a></td>";
                echo "</tr>";
            }
        }
    }
}
?>
