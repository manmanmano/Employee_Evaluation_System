<?php
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");

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
                mysqli_stmt_bind_result($stmt, $title, $name, $email, $sPassword, $token);
                if (mysqli_stmt_fetch($stmt)) {
                    if ($password == $sPassword) {
                        $_SESSION['name'] = $name;
                        $_SESSION['title'] = $title;
                        $_SESSION['token'] = $token;
                    }
                } else {
                    echo "Incorrect username or password!";
                }
            } else {
                echo "Incorrect username or password!";
            }
        } else {
            echo "<h1>Something went wrong! Please retry.</h1>";
        }
    }
}

function redirect($title) {
    if (isset($_SESSION['name'])) {
        if ($title == "employer") {
            header("refresh:0; ../employer/employer.php");
        } else if ($title == "employee") {
            header("refresh:0; ../employee/employee.php");
        }
    }
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

$title = $_POST['title'];                                                   
if (!isset($title) || empty($title)) {                                      
    die("Radio button left blank!");                                        
} else {                                                                    
    if ($title != "employee" && $title != "employer") {                     
        die("Corrupted data in radio input!");                              
    }                                                                       
}                                                                           

$username = $_POST['email'];
if (!filter_var($username, FILTER_VALIDATE_EMAIL) || empty($username)) {
    die("Invalid email in input!");                                         
}                                                                           
    
$password = $_POST['password'];    
if (strlen($password) < 8 || empty($password)) {          
    die("Invalid password in input!");                           
}                                                                           
    
validateCredentials($title, $username, $password);

redirect($title);

mysqli_close($link);
?> 
