<?php
require_once("../sessionstart.php");

if ($_SESSION['title'] != 'employee') {
    die("Session expired!");
}

if (isset($_GET['week']) && isset($_GET['year'])) {
    include("../usersData/connect.db.php");
    include("../usersData/sanitizeInputVar.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $name = "'" . $_SESSION['name'] . "'";
    $query = mysqli_prepare($link, "SELECT * FROM token_? WHERE name=? AND week=? AND year=?;");
    mysqli_stmt_bind_param($query, "ssii", $token, $name, $_GET['week'], $_GET['year']);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $sqlname, $week, $year, $average, $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize, $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality);
    echo $sqlname;
    mysqli_stmt_close($query);

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
        echo "<td><a href='?week=" . $week . "&year=" . $year . "' onclick='modal()'>", $grades[$year][$week], "</a></td>";
        echo "</tr>";
    } else {
        foreach ($grades as $year => $weeks) {
            foreach ($weeks as $week => $grade) {
                echo "<tr>";
                echo "<td>", $week, "</td>";
                echo "<td>", $year, "</td>";
                echo "<td><a href='?week=" . $week . "&year=" . $year . "' onclick='modal()'>", $grade, "</a></td>";
                echo "</tr>";
            }
        }
    }
}
?>
