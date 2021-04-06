<?php
function createTable() {
    $grades = array(5 => 4.5, 6 => 3.9, 7 => 2.9);
    $week = intval(substr(date("W", strtotime($_POST['date']), 1, 1)));
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
