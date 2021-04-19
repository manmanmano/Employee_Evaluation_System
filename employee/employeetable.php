<?php
require_once("../sessionstart.php");

if ($_SESSION['title'] != 'employee') {
    die("Session expired!");
}

function getGrade($item, $token) {
    include("../usersData/connect.db.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $query = "SELECT " . $item . " FROM token_" . $token . "WHERE name='" . $_SESSION['name'] . "';";
    $result = mysqli_query($link, $query);
    echo $result;
    return $result;
}

function createTable($token) {
    include("../usersData/connect.db.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $grades = array();
    $years = array();
    $query = "SELECT week, year, average FROM token_" . $token . " WHERE name='" . $_SESSION['name'] . "';";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        if (!in_array($row['year'], $years)) {
            array_push($years, $row['year']);
        }
    }
    foreach ($years as $year) {
        $weeks = array();
        $query = "SELECT name, week, year, average FROM token_" . $token . ";";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['name'] == $_SESSION['name'] && $row['year'] == $year) {
                $weeks[$row['week']] = $row['average'];
            }
        }
        $grades[$year] = $weeks;
        unset($weeks);
    }
    $week = intval(date("W", strtotime($_GET['date'])));
    if (isset($_GET['search']) && !empty($_GET['date'])) {
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("Y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        echo "<tr>";
        echo "<td>", $week, "</td>";
        echo "<td>", $year, "</td>";
        echo "<td><a href='#' onclick='modal()'>", $grades[$year][$week], "</a></td>";
        echo "</tr>";
    } else {
        foreach ($grades as $year => $weeks) {
            foreach ($weeks as $week => $grade) {
                echo "<tr>";
                echo "<td>", $week, "</td>";
                echo "<td>", $year, "</td>";
                echo "<td><a href='#' onclick='modal()'>", $grade, "</a></td>";
                echo "</tr>";
            }
        }
    }
}
?>
