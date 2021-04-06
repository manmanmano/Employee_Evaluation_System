<?php
function createTable() {
    $grades = array(5 => 4.5, 6 => 3.9, 7 => 2.9);
    $week = intval(date("W", strtotime($_POST['date'])));
    if (isset($_POST['search']) && !empty($_POST['date'])) {
        $month = intval(date("M", strtotime($_POST['date'])));
        $day = intval(date("D", strtotime($_POST['date'])));
        $year = intval(date("Y", strtotime($_POST['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
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
