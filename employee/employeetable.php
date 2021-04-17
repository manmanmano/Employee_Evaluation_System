<?php
require_once("../sessionstart.php");

if ($_SESSION['title'] != 'employee') {
    die("Incorrect credentials");
}

function createTable($token) {
    include("../usersData/connect.db.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $grades = array();
    $query = "SELECT name, week, year, average FROM token_" . $token . ";";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['name'] == $_SESSION['name']) {
            $grades[$row['year']] = array($row['week'] => $row['average']);
        }
    }
    $week = intval(date("W", strtotime($_GET['date'])));
    $year = intval(date("y", strtotime($_GET['date'])));
    if (isset($_GET['search']) && !empty($_GET['date'])) {
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        echo "<tr>";
        echo "<td>", $week, "</td>";
        echo "<td>", $year, "</td>";
        echo "<td class='evals'>", $grades[$year][$week], "</td>";
        echo "</tr>";
    } else {
        foreach ($grades as $year => ($week => $grade)) {
            echo "<tr>";
            echo "<td>", $week, "</td>";
            echo "<td>", $year, "</td>";
            echo "<td class='evals'>", $grade,"</td>";
            echo "</tr>";
        }
    }
}
?>
