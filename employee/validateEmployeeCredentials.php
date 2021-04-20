<?php 
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");

// checks if password and cPassword match
function matching_passwords($password, $cpassword)
{
    if ($password != $cpassword) {
        // error matching passwords
        exit('Your passwords do not match.');
    }
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
                echo "<h1>Email already exists!</h1>";
                return false;
            } else {
                return true;
            }
        }
        mysqli_stmt_close($stmt);
    }
}

function updateEmail($link, $email, $oldEmail) {
    $query = "UPDATE users SET email=? WHERE email=?";
    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to params
        mysqli_stmt_bind_param($stmt, "ss", $email, $oldEmail);
        //attempt to execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            echo "<h1>Something went wrong! Please retry!</h1>";
        }
    }
}
        

if (isset($_POST['newData'])) {                                                   
    //connect to database, in case of failure give error
    $link = mysqli_connect($server, $user, $password, $database);
    if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

    $opassword = $_POST['oldPassword'];
    $oldHash = password_hash($opassword, PASSWORD_DEFAULT);
    if (isset($opassword) && !empty($opassword)) {
        if (!password_verify($opassword, $oldHash)) {
            exit("Incorrect current password!");
        }
    }

    $password = $_POST['newPassword'];
    if (!empty($opassword) && isset($password) && !empty($password)) {
        if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
            exit("Invalid password");
        }
    } 

    $cpassword = $_POST['newcPassword'];
    if (!empty($password) && isset($cpassword) && !empty($cpassword)) {
        if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $cpassword)) {
            exit("Invalid password");
        }
    }

    matching_passwords($password, $cpassword);

    $email = $_POST['newEmail'];
    if (isset($email) && !empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("Invalid email");
        } else {
           $bool =  checkEmail($link, $email);
           if ($bool == true) {
               updateEmail($link, $email, $_SESSION['email']);
               $_SESSION['email'] = $email;
           }
        }
    }

    mysqli_close($link);
    header("refresh:0; updateSuccess.php");
}


?>
