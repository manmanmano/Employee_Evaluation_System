<?php

// checks if password and cPassword match
function matching_passwords($password, $cpassword)
{
    // Your validation code.
    if (empty($password)) {
        echo "Password is required.";
        return false;
    }
    else if ($password != $cpassword) {
        // error matching passwords
        echo 'Your passwords do not match.';
        return false;
    }
    // passwords match
    return true;
}




if (!file_exists('users')) {
    mkdir('usersData');
}
  fopen('../usersData/users.csv');

  $user = '';

  $name = $_POST['name'];
  if (empty($_POST['name'])){
      exit("Please enter Your name.");
  }
  // /^[a-zA-Z ]*$/ letters and whitespace or ^[A-Za-z]+(\s[A-Za-z]+){0,2}$ Only First, First & Last(?), First, Middle and Last
  if(!preg_match("/^[a-zA-Z ]*$/", $name)){
      exit("Please enter full name and use Latin alphabet.");
      }

  $user .= $name;
  $user .= '; ';

  $email = $_POST['email'];
  if (empty($_POST['email'])){
      exit("Please enter Your email.");
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      exit("Please enter a valid email.");
  }
  $user .= $email;
  $user .= '; ';

  /*

  $position = $_POST['position'];
  if($position == "employee"){

  }
  if($position == "employer"){

  }
  */


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
  $user .= '; ';
  $user .= $cpassword;
  $user .= '; ';

	$user .= "\r\n";

	$return = file_put_contents('usersData/users.csv', $user, FILE_APPEND);

	fclose('usersData/users.csv');

  header("refresh:0;registercomplete.html");
?>
