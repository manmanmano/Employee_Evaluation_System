<?php
//starting session, getting database parameters and sanitization function
require_once("../sessionstart.php");
include_once("../usersData/connect.db.php");
include_once("../usersData/sanitizeInputVar.php");

//checking user title
if ($_SESSION['title'] != 'employer') {
    header("refresh:2;url=employer.php");
    die("<h1>Session expired!");
}

//connecting to database
$link = mysqli_connect($server, $user, $password, $database);
if (!$link) {
    header("refresh:2;url=employer.php");
    die("Connection to DB failed: " . mysqli_connect_error());
}

//getting variables to form query
$name = sanitizeInputVar($link, $_GET['name']);
$week = sanitizeInputVar($link, $_GET['week']);
$year = sanitizeInputVar($link, $_GET['year']);
//deleting the evaluation from table
$query = "DELETE FROM token_" . $_SESSION['token'] . " WHERE name='" . $name . "' AND week=" . $week . " AND year=" . $year . ";";
$result = mysqli_query($link, $query);

mysqli_close($link);
header("refresh:0;url=employer.php");
?>
