<?php
require_once("../usersData/connect.db.php");
session_name('sesRegister');
session_set_cookie_params(['path' => '/~madang/icd0007_project/']);
session_start();

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

function checkEmail($link, $email) {
        //prepare a select statement
    $query = "SELECT email FROM users WHERE email=?";

    if ($stmt = mysqli_prepare($link, $query)) {
        //bind the email to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $email);
        //if execution is successful check for the email 
        if (mysqli_stmt_execute($stmt)) {
            //store the result locally
            mysqli_stmt_store_result($stmt);
            //if email does not exist exit
            if (mysqli_stmt_num_rows($stmt) == 1) {
                echo "<h1>";
                die("Email already exists!");
                echo "</h1>";
            }
        }
        mysqli_stmt_close($stmt);
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

function addUser($link, $title, $name, $email, $password, $token, $bossToken) {
    $query = "INSERT INTO users (title, name, email, password, token)
        VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to parameters
        //if the position is employer than use the session token, if not use the token
        if ($title == "employer") {
            mysqli_stmt_bind_param($stmt, "sssss", $title, $name, $email, $password, $bossToken);
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $title, $name, $email, $password, $token);
        }
        //attempt to execute the statement
        if (mysqli_stmt_execute($stmt)) {
            //if successful redirect to the next page
            header("refresh:0;registerComplete.php");
        } else {
            echo "<h1>Something went wrong! Please retry!</h1>";
        }
        mysqli_stmt_close($stmt);
    }
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
if (!isset($position) || empty($position)) {
  exit("Position must be selected.");
} else {
  if ($position != "employee" && $position != "employer") {
    exit("Position must be 'Employee' or 'Employer'");
  }
}

$employeeToken = $_POST['company'];
if ($position == "employee" && empty($employeeToken)) {
  exit("Token is required for registering");
}

$password = $_POST['password'];
if (empty($_POST['password'])) {
    exit("Please choose a password.");
}
if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
    exit("Password must have at least 8 characters and at least one number, one uppercase letter and one lowercase letter.");
}

//check if the email already exist
checkEmail($link, $email);

$cpassword = $_POST['cPassword'];
//check if passwords match
matching_passwords($password, $cpassword);


$employerToken = $_SESSION['tokenGen'];
//if registrant is an employee check his token, if employer create a new table
if ($position == "employee") {
    checkToken($link, $employeeToken);
} else if ($position == "employer") {
    $copyTable = 
        "CREATE TABLE IF NOT EXISTS token_" . $employerToken . " LIKE token_11878766e47b78d6d5adb81ff2aed1;";
    mysqli_query($link, $copyTable);
}

//hash the password before storing it
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

//in the end add a new user
addUser($link, $position, $name, $email, $hashedPassword, $employeeToken, $employerToken);

//close the connection to the db
mysqli_close($link);
session_unset();
session_destroy();
?>
