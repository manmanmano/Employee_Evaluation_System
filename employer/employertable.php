<?php
//start session
require("../sessionstart.php");

//checking user title
if ($_SESSION['title'] != 'employer') {
     header("Refresh: 7; url=../index.php");
     die ("Your session has expired");
}

//function to create employees array
function createNames($token) {
    include("../usersData/connect.db.php");

    //connection to database
    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $query = "SELECT name FROM users WHERE token='". $token . "' AND title='employee' ORDER BY ASC;";
    $result = mysqli_query($link, $query);
    $names = array();
    //fill the names array with employees' names
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names, $row['name']);
    }
    mysqli_close($link);
    //create dynamic options for select tag
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

//function to create dynamic array
function createTable($token) {
    include("../usersData/connect.db.php");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }
    
    $names = array();
    $employees = array();
    $query = "SELECT name FROM users WHERE token='". $token . "' AND title='employee' ORDER BY ASC;";
    $result = mysqli_query($link, $query);
    //fill the names array with employees' names
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names, $row['name']);
    }
    //create arrays of years for each employee
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
        //adds weeks and grades to each year
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
    //user filters only date
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
                echo "<td><a href='employeredit.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Edit</a></td>";
                echo "<td><a href='employerdelete.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Delete</button></td>";
                echo "</tr>";
            }
        }
    //user filters only name
    } elseif (isset($_GET['search']) && empty($_GET['date']) && !empty($_GET['name'])) {
        $name = $_GET['name'];
        foreach ($employees[$name] as $year => $weeks) {
            foreach ($weeks as $week => $grade) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td>", $year, "</td>";
                echo "<td class='evals'>", $grade, "</td>";
                echo "<td><a href='employeredit.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Edit</a></td>";
                echo "<td><a href='employerdelete.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Delete</button></td>";
                echo "</tr>";
            }
        }
    //user filters both name and date
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
        echo "<td><a href='employeredit.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Edit</a></td>";
        echo "<td><a href='employerdelete.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Delete</button></td>";
        echo "</tr>";
    //user does not filter table
    } else {
        foreach ($employees as $name => $years) {
            foreach ($years as $year => $weeks) {
                foreach ($weeks as $week => $grade) {
                    echo "<tr>";
                    echo "<td>", $name, "</td>";
                    echo "<td>", $week, "</td>";
                    echo "<td>", $year, "</td>";
                    echo "<td class='evals'>", $grade, "</td>";
                    echo "<td><a href='employeredit.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Edit</a></td>";
                    echo "<td><a href='employerdelete.php?week=" . $week . "&year=" . $year . "&name=" . $name . "'>Delete</button></td>";
                    echo "</tr>";
                }
            }
        }
    }
}
?>
