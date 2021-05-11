<?php
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");
if ($_SESSION['title'] != 'employer') {
    header("refresh:2;url=../index.php");
    die("<h1>Your session has expired!</h1>");
}
//connect to the database
$link = mysqli_connect($server, $user, $password, $database);
if (!$link) {
    header("refresh:2;url=employer.php");
    die("<h1>Connection to DB failed: " . mysqli_connect_error());
}
//query to drop the table of the company
$query = "DROP TABLE token_" . $_SESSION['token'] . ";";
//prepare the statement
$stmt = mysqli_prepare($link, $query);
//execute the statement
mysqli_stmt_execute($stmt);
//close the statement
mysqli_stmt_close($stmt);
//query to delete the users from the users' table
$query = "DELETE FROM users WHERE token = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['token']);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
//close the connection to db
mysqli_close($link);

//redirect to index.php after distruction and exit the code
header("refresh:7; ../index.php");
exit("<h1>Your company has been successfully deleted!<br>Thank you for choosing us
    as your business partners!<br>You will now be redirected to the main page.<br>
    Until next time!</h1>");
?>
