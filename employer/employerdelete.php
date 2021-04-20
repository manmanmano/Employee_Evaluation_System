<?php
require_once("../sessionstart.php");
include_once("../usersData/connect.db.php");
include_once("../usersData/sanitizeInputVar.php");

if ($_SESSION['title'] != 'employer') {
    die("Session expired!");
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

$name = sanitizeInputVar($link, $_GET['name']);
$week = sanitizeInputVar($link, $_GET['week']);
$year = sanitizeInputVar($link, $_GET['year']);
echo $name;
echo $week;
echo $year;
$query = "DELETE FROM token_" . $_SESSION['token'] . " WHERE name='" . $name . "' AND week=" . $week . " AND year=" . $year . ";";
$result = mysqli_query($link, $query);

mysqli_close($link);
header("refresh:0;url=employer.php");
?>
