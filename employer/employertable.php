<?php
require("../sessionstart.php");

if ($_SESSION['title'] != 'employer') {
    die("Incorrect credentials");
}

function createNames($token) {
    include("../usersData/connect.db.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $query = "SELECT name FROM users WHERE token='". $token . "' AND title='employee';";
    $result = mysqli_query($link, $query);
    $names = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names, $row['name']);
    }
    mysqli_close($link);
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

function createTable($token) {
    include("../usersData/connect.db.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }
    
    $names = array();
    $employees = array();
    $query = "SELECT name FROM users WHERE token='". $token . "' AND title='employee';";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names, $row['name']);
    }
    foreach ($names as $name) {
        $years = array();
        $evaluation = array();
        $query = "SELECT year FROM token_" . $token . " WHERE name='" . $name . "';";
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
                if ($row['name'] == $name && $row['year'] == $year) {
                    $weeks[$row['week']] = $row['average'];
                }
            }
            $evaluation[$year] = $weeks;
            unset($weeks);
        }
        $employees[$name] = $evaluation;
        unset($evaluation);
    }
    mysqli_close($link);
    if (isset($_GET['search']) && !empty($_GET['date']) && empty($_GET['name'])) {
        $week = intval(date("W", strtotime($_GET['date'])));
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("Y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        foreach ($employees as $name => $grades) {
            if (!empty($grades[$year][$week])) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td>", $year, "</td>";
                echo "<td class='evals'>", $grades[$year][$week], "</td>";
                echo "</tr>";
            }
        }
    } elseif (isset($_GET['search']) && empty($_GET['date']) && !empty($_GET['name'])) {
        $name = $_GET['name'];
        foreach ($employees[$name] as $year => $weeks) {
            foreach ($weeks as $week => $grade) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td>", $year, "</td>";
                echo "<td class='evals'>", $grade, "</td>";
                echo "</tr>";
            }
        }
    } elseif (isset($_GET['search']) && !empty($_GET['date']) && !empty($_GET['name'])) {
        $week = intval(date("W", strtotime($_GET['date'])));
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("Y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        $name = $_GET['name'];
        echo "<tr>";
        echo "<td>", $name, "</td>";
        echo "<td>", $week, "</td>";
        echo "<td>", $year, "</td>";
        echo "<td class='evals'>", $employees[$name][$year][$week], "</td>";
        echo "</tr>";
    } else {
        foreach ($employees as $name => $years) {
            foreach ($years as $year => $weeks) {
                foreach ($weeks as $week => $grade) {
                    echo "<tr>";
                    echo "<td>", $name, "</td>";
                    echo "<td>", $week, "</td>";
                    echo "<td>", $year, "</td>";
                    echo "<td class='evals'>", $grade, "</td>";
                    echo "</tr>";
                }
            }
        }
    }
}
?>
