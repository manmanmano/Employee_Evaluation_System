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
    mysqli_stmt_close($stmt);
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

function addUser($link, $position, $name, $email, $hashedPassword, $employeeToken, $employerToken) {
    //insert a new user
    $query = "INSERT INTO users (title, name, email, password, token)
        VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $query)) {
        //before binding check the position of the person
        if ($position == "employer") {
            //if employer than then the employee token
            mysqli_stmt_bind_param($stmt, "sssss",
                $position, $name, $email, $hashedPassword, $employerToken);
        } else {
            //if not employer than employee
            mysqli_stmt_bind_param($stmt, "sssss",
                $position, $name, $email, $hashedPassword, $employeeToken);
        }
        //if execute is successful redirect to registrationSuccess
        if (mysqli_stmt_execute($stmt)) {
            header("refresh:0;registerComplete.php");
        } else {
            echo "<h1>Something went wrong! Please retry later.</h1>";
        }
    }
    mysqli_stmt_close($stmt);
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
//check if passwords match
matching_passwords($password, $cpassword);

//if registrant is an employee check his token
if ($position == "employee") {
    checkToken($link, $employeeToken);
}

//hash the password before storing it
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//in the end add a new user
$employerToken = $_SESSION['tokenGen'];
addUser($link, $position, $name, $email, $hashedPassword, $employeeToken, $employerToken);

//close the connection to the db
mysqli_close($link);
session_unset();
session_destroy();
?>
