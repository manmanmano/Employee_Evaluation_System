<?php
require("../sessionstart.php");

if ($_SESSION['title'] != 'employer') {
    die("Incorrect credentials");
}

function createNames($token) {
    include_once("../usersData/connect.db.php");
    include_once("../usersData/sanitizeInputVar");

    $link = mysqli_connect($server, $user, $password, $database);

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $query = mysqli_prepare($link, "SELECT name FROM users WHERE token=?;");
    mysqli_stmt_bind_param($query, "s", sanitizeInputVar($link, $token));
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $name);
    $names = array();
    while ($row = mysqli_stmt_fetch($query)) {
        array_push($names, $name);
    }
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

function createTable() {
    $csvfile = fopen("Eval.csv", "r");
    $names = array();
    $employees = array();
    while ($data = fgetcsv($csvfile, 1000, ";")) {
        if (!in_array($data[0], $names) && $data[3] == $_SESSION['token']) {
            array_push($names, $data[0]);
        }
    }
    foreach ($names as $name) {
        $evaluations = array();
        $csvfile = fopen("Eval.csv", "r");
        while ($data = fgetcsv($csvfile, 1000, ";")) {
            if ($name == $data[0] && $data[3] == $_SESSION['token']) {
                $evaluations[$data[1]] = $data[2];
            }
        }
        $employees[$name] = $evaluations;
        fclose($csvfile);
        unset($evaluations);
    }
    if (isset($_GET['search']) && !empty($_GET['date']) && empty($_GET['name'])) {
        $week = intval(date("W", strtotime($_GET['date'])));
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        foreach ($employees as $name => $grades) {
            if (!empty($grades[$week])) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td class='evals'>", $grades[$week], "</td>";
                echo "</tr>";
            }
        }
    } elseif (isset($_GET['search']) && empty($_GET['date']) && !empty($_GET['name'])) {
        $name = $_GET['name'];
        foreach ($employees[$name] as $week => $grade) {
            echo "<tr>";
            echo "<td>", $name, "</td>";
            echo "<td>", $week, "</td>";
            echo "<td class='evals'>", $grade, "</td>";
            echo "</tr>";
        }
    } elseif (isset($_GET['search']) && !empty($_GET['date']) && !empty($_GET['name'])) {
        $week = intval(date("W", strtotime($_GET['date'])));
        $month = intval(date("m", strtotime($_GET['date'])));
        $day = intval(date("d", strtotime($_GET['date'])));
        $year = intval(date("y", strtotime($_GET['date'])));
        if (!checkdate($month, $day, $year)) {                                                 
            die("Invalid date set!");
        }
        $name = $_GET['name'];
        echo "<tr>";
        echo "<td>", $name, "</td>";
        echo "<td>", $week, "</td>";
        echo "<td class='evals'>", $employees[$name][$week], "</td>";
        echo "</tr>";
    } else {
        foreach ($employees as $name => $grades) {
            foreach ($grades as $week => $grade) {
                echo "<tr>";
                echo "<td>", $name, "</td>";
                echo "<td>", $week, "</td>";
                echo "<td class='evals'>", $grade, "</td>";
                echo "</tr>";
            }
        }
    }
}

?>
