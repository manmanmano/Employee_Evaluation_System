<?php
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");

//check if the token is valid
function checkToken($link, $token) {
    //prepare a select statement
    $query = mysqli_prepare($link,
        "SELECT title, token FROM users WHERE title='employer' AND token=?");

    if ($stmt = mysqli_prepare($link, $query)) {
        //bind the token to the prepared statement
        mysqli_stmt_bind_param($query, "s", $token);
        //if execution is successful check for the token
        if (mysqli_stmt_execute($query)) {
            //store the result locally
            mysqli_stmt_store_result($query);
            //if token does not exist exit
            if (mysqli_stmt_num_rows($query) != 1) {
                die("Token does not exist!");
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

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

$user = '';

$position = $_POST['position'];
if($position == "employee"){
  $user .= $position;
  $user .= ';';
}

if($position == "employer"){
  $user = 'employer';
  $user .= ';';
}

$name = $_POST['name'];
if (empty($_POST['name'])){
    exit("Please enter Your name.");
}
// /^[a-zA-Z ]*$/ letters and whitespace or ^[A-Za-z]+(\s[A-Za-z]+){0,2}$ Only First, First & Last(?), First, Middle and Last
if(!preg_match("/^[a-zA-Z ]*$/", $name)){
    exit("Please enter full name and use Latin alphabet.");
    }

$user .= $name;
$user .= ';';

$email = $_POST['email'];
if (empty($_POST['email'])){
    exit("Please enter Your email.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email.");
}

$user .= $email;
$user .= ';';

$position = $_POST['position'];
if(!isset($position) || empty($position)){
  exit("Position must be selected.");
}else{
  if($position != "employee" && $position != "employer"){
    exit("Position must be 'Employee' or 'Employer'");
  }
}

$employeeToken = $_POST['company'];
if($position == "employee" && empty($employeeToken)){
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


$user .= $password;
$user .= ';';

if($position == "employee"){
  $user .= $employeeToken;
}
if($position == "employer"){
  $user .= $_SESSION['tokenGen'];
}

checkToken($link, $_POST['company']);

file_put_contents('../usersData/users.csv', $user, FILE_APPEND);

session_unset();
session_destroy();

header("refresh:0;registerComplete.php");

?>
