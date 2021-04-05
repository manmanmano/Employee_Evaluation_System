<?php
function createTable() {
    $grades = array(5 => 4.5, 6 => 3.9, 7 => 2.9);
    if (isset($_POST['search']) && intval(substr($_POST['week'], 6, 2)) != 0) {
        $week = intval(substr($_POST['week'], 6, 2));
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
