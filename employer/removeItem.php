<?php
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

$query = "DROP TABLE token_" . $_SESSION['token'] . ";";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$query = "DELETE FROM users WHERE token = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['token']);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

mysqli_close($link);


header("refresh:7; ../index.php");
exit("<h1>Your company has been successfully deleted!<br>Thank you for choosing us
    as your business partners!<br>You will now be redirected to the main page.<br>
    Until next time!</h1>");
?>
