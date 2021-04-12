<?php
session_name('sesRegister');
session_start();
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

$user = array();

$position = $_POST['position'];
if($position == "employee"){
  $user[0] = $position;
}

if($position == "employer"){
  $user[0] = 'employer';
}

$name = $_POST['name'];
if (empty($_POST['name'])){
    exit("Please enter Your name.");
}
// /^[a-zA-Z ]*$/ letters and whitespace or ^[A-Za-z]+(\s[A-Za-z]+){0,2}$ Only First, First & Last(?), First, Middle and Last
if(!preg_match("/^[a-zA-Z ]*$/", $name)){
    exit("Please enter full name and use Latin alphabet.");
    }

$user[1] = $name;

$email = $_POST['email'];
if (empty($_POST['email'])){
    exit("Please enter Your email.");
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email.");
}

$user[2] = $email;

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


$user[3] = $password;

if($position == "employee"){
  $user[4] = $employeeToken;
}
if($position == "employer"){
  $user[4] = $_SESSION['tokenGen'];
}

require ('tokenExists.php');
$handle = fopen('../usersData/users.csv', 'r');
checkCsv($users, $_POST['company']);
fclose($handle);

$users = fopen('../usersData/users.csv', 'a');
$return = fputcsv($users, $user, ";");
fclose($users);

session_unset();
session_destroy();

header("refresh:0;registerComplete.php");

?>
