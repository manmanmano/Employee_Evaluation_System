<?php
//starts the session
require_once("../sessionstart.php");

//checks the title of the user
if ($_SESSION['title'] != 'employee') {
     header("Refresh: 7; url=../index.php");
     die ("Your session has expired");
}

//if user wants to filter the table
if (isset($_GET['week']) && isset($_GET['year'])) {
    //database connection parameters
    include("../usersData/connect.db.php");
    //query sanitization function
    include("../usersData/sanitizeInputVar.php");

    //connection to database
    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    //query creation
    $name = "'" . $_SESSION['name'] . "'";
    $week = sanitizeInputVar($link, $_GET['week']);
    $year = sanitizeInputVar($link, $_GET['year']);
    $query = "SELECT * FROM token_" . $_SESSION['token'] . " WHERE name=" . $name . " AND week=" . $week . " AND year=" . $year . ";";
    $result = mysqli_query($link, $query);
    //binding the variables from query
    while ($row = mysqli_fetch_assoc($result)) {
        $initiative = $row['initiative'];
        $gbProjects = $row['group_based_projects'];
        $follows = $row['follows_instructions'];
        $leadership = $row['leadership'];
        $focused = $row['focused'];
        $prioritize = $row['prioritize'];
        $workers = $row['communication_coworkers'];
        $superiors = $row['communication_superiors'];
        $dependable = $row['dependable'];
        $punctualAss = $row['assignments_on_time'];
        $punctualTime = $row['arrives_on_time'];
        $quality = $row['quality'];
    }
    //closing query
    mysqli_close($query);
}

//create dynamic table function
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
    //creating an array of years
    while ($row = mysqli_fetch_assoc($result)) {
        if (!in_array($row['year'], $years)) {
            array_push($years, $row['year']);
        }
    }
    foreach ($years as $year) {
        $weeks = array();
        $query = "SELECT name, week, year, average FROM token_" . $token . ";";
        $result = mysqli_query($link, $query);
        //adding weeks and grades to years
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
        //getting and checking the date
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("Y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        //if user filters the table
        echo "<tr>";
        echo "<td>", $week, "</td>";
        echo "<td>", $year, "</td>";
        echo "<td><a class='evals'>", 
            $grades[$year][$week], "</a></td>";
        echo "</tr>";    
    //if the user does not filter the table
    } else {
        foreach ($grades as $year => $weeks) {
            foreach ($weeks as $week => $grade) {
                echo "<tr>";
                echo "<td>", $week, "</td>";
                echo "<td>", $year, "</td>";
                echo "<td><a class='evals'>", $grade, "</a></td>";
                echo "</tr>";
            }
        }
    }
}
?>
