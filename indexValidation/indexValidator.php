<?php
//sessionstart contains the path and command to start the session
require_once("../sessionstart.php");
//contains the connection to the database
require_once("../usersData/connect.db.php");
//this function checks for the user credentials.
function validateCredentials($link,  $email, $password) {
    $query = "SELECT title, name, email, password, token FROM users
        WHERE email=?";
    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $email);
        //execute the statement
        if (mysqli_stmt_execute($stmt)) {
            //store results locally
            mysqli_stmt_store_result($stmt);
            //if username exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                //bind result to variables
                mysqli_stmt_bind_result($stmt, $title, $name, $email, $hashedPassword, $token);
                //fetch the results
                if (mysqli_stmt_fetch($stmt)) {
                    //confront passwords. if they match initialize session variables
                    if (password_verify($password, $hashedPassword)) {
                        //contains the namme of the user
                        $_SESSION['name'] = $name;
                        //contains the title of the user
                        $_SESSION['title'] = $title;
                        //contains the token of the company where the user works
                        $_SESSION['token'] = $token;
                        //contains the email of the user
                        $_SESSION['email'] = $email;
                        //if everything is right an empty string is returned
                        $error = "";
                        return $error;
                    } else {
                        //if the password is wrong return an error message
                        $error =  "<h1>Incorrect username or password!</h1>";
                        echo $error;
                        header("refresh:2;url=../index.php");
                    }
                }
            } else {
                //if the email has not been found return an error message
                $error = "<h1>Incorrect username or password!</h1>";
                echo $error;
                header("refresh:2;url=../index.php");
            }
        } else {
            //something else went wrong
            echo "<h1>Something went wrong! Please retry.</h1>";
            header("refresh:2;url=../index.php");
        }
    }
    //close the query
    mysqli_stmt_close($stmt);
}

//this funciton redirects the user to the right page if the credentials are correct
function redirect($title) {
    if (isset($_SESSION['name'])) {
        //if the positoin chosen is employer then redirect to the employer page
        if ($title == "employer") {
            header("refresh:0; ../employer/employer.php");
            //if the position is employee then redirect to employee.php
        } elseif ($title == "employee") {
            header("refresh:0; ../employee/employee.php");
            //if position is corrupted than exit the code
        } else {
            die("<h1>Invalid position!</h1>");
            header("refresh:2;url=../index.php");
        }
    }
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) { 
    echo "Connection to DB failed: " . mysqli_connect_error();
    header("refresh:2;url=../index.php");
}
//this string will contain possible errors in input and print it on the form
$credentialError = "";
//check for the position
$title = $_POST['title'];
//if the title is not set or it is empty then exit the code
if (!isset($title) || empty($title)) {
    echo "<h1>Radio button left blank!</h1>";
    header("refresh:2;url=../index.php");
} else {
    //if the title is not employee nor employer than exit the code and print error
    if ($title != "employee" && $title != "employer") {
        echo "<h1>Corrupted data in radio input!</h1>";
        header("refresh:2;url=../index.php");
    }
}
//check for the username/email
$username = $_POST['email'];
//check if the format of the email is correct, if not exit and print error message
if (!filter_var($username, FILTER_VALIDATE_EMAIL) || empty($username)) {
    echo "<h1>Invalid email!</h1>";
    header("refresh:2;url=../index.php");
}
//check for the password
$password = $_POST['password'];
//if the password is left blank or it is less than 8 char then exit and print error message
if (strlen($password) < 8 || empty($password)) {
    echo "<h1>Invalid password in input!</h1>";
    header("refresh:2;url=../index.php");
}
//this function validates the credentials inputted in the form. It returns an empty string if successful
//and returns an error message if not
$credentialError = validateCredentials($link, $username, $password, $credentialError);
//if the credentialError string is empty than redirect the user
if ($credentialError == "") {
    redirect($title);
} else {
    exit();
}
//close the connection to the database
mysqli_close($link);

?> 
