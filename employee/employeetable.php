<?php
function createTable() {
    $grades = array(05 => 4.5, 6 => 3.9, 7 => 2.9);
    $week = date("W", strtotime($_POST['date']));
    if (isset($_POST['search']) && !empty($_POST['date'])) {
        echo "<tr>";
        echo "<td>", $week, "<td>";
        echo "<td><a href='grade popup'>", $grades[$week], "</a></td>";
        echo "</tr>";
    } else {
        foreach ($grades as $week => $grade) {
            echo "<tr>";
            echo "<td>", $week, "</td>";
            echo "<td><a href='grade popup'>", $grade, "</a></td>";
            echo "</tr>";
        }
    }
}
?>
