<?php
require_once("../sessionstart.php");
include_once("../usersData/connect.db.php");
include_once("../sanitizeInputvar.php");

if ($_SESSION['title'] != 'employer') {
    die("Session expired!");
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

$name = sanitizeInputvar($link, $_GET['name']);
$week = sanitizeInputvar($link, $_GET['week']);
$year = sanitizeInputvar($link, $_GET['year']);
$query = "DELETE FROM token_" . $_SESSION['token'] . " WHERE name='" . $name . "' AND week=" . $week . " AND year=" . $year . ";";
$result = mysqli_query($link, $query);

mysqli_close($link);
?>
