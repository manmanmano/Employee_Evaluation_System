<?php
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");

//check if the token is valid
function checkToken($link, $token) {
    //prepare a select statement
    $query = "SELECT title, token FROM users WHERE title='employer' AND token=?";

    if ($stmt = mysqli_prepare($link, $query)) {
        //bind the token to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $token);
        //if execution is successful check for the token
        if (mysqli_stmt_execute($stmt)) {
            //store the result locally
            mysqli_stmt_store_result($stmt);
            //if token does not exist exit
            if (mysqli_stmt_num_rows($stmt) != 1) {
                echo "<h1>";
                die("Invalid token!");
                echo "</h1>";
            }
        }
    }
}

// checks if password and cPassword match
function matching_passwords($password, $cpassword)
{
    // Your validation code.
    if (empty($password)) {
        exit("Password is required.");
    }
    else if ($password != $cpassword) {
        // error matching passwords
        exit('Your passwords do not match.');

    }
    // passwords match
    return true;
}

//connect to database, in case of failure give error
$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

$name = $_POST['name'];
if (empty($_POST['name'])){
    exit("Please enter Your name.");
}
// /^[a-zA-Z ]*$/ letters and whitespace or ^[A-Za-z]+(\s[A-Za-z]+){0,2}$ Only First, First & Last(?), First, Middle and Last
if(!preg_match("/^[a-zA-Z ]*$/", $name)){
    exit("Please enter full name and use Latin alphabet.");
}

$email = $_POST['email'];
if (empty($_POST['email'])) {
    exit("Please enter Your email.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email.");
}

$position = $_POST['position'];
if (!isset($position) || empty($position)){
  exit("Position must be selected.");
} else {
  if ($position != "employee" && $position != "employer"){
    exit("Position must be 'Employee' or 'Employer'");
  }
}

$employeeToken = $_POST['company'];
if ($position == "employee" && empty($employeeToken)){
  exit("Token is required for registering");
}

$password = $_POST['password'];
if (empty($_POST['password'])){
    exit("Please choose a password.");
}
if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)){
    exit("Password must have at least 8 characters and at least one number, one uppercase letter and one lowercase letter.");
}

$cpassword = $_POST['cPassword'];

matching_passwords($password, $cpassword);

checkToken($link, $employeeToken);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

addUser($link, $position, $name, $email, $hashedPassword, $employeeToken, $_SESSION['tokenGen']);

session_unset();
session_destroy();

header("refresh:0;registerComplete.php");

?>
