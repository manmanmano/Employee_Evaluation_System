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

function verifyPassword($link, $email, $password) {
    $query = "SELECT password FROM users WHERE email=?";
    if ($stmt = mysqli_prepare($link, $query)) {
        //bind the email to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
        //if execution is successful check for the email
        if (mysqli_stmt_execute($stmt)) {
            //store the result locally
            mysqli_stmt_store_result($stmt);
            //if pwd exists
            if (mysqli_stmt_num_rows($stmt) == 1) {
                //bind result to variables
                mysqli_stmt_bind_result($stmt, $currentPassword);
                //fetch the results
                if (mysqli_stmt_fetch($stmt)) {
                    //confront passwords. if they do not match error
                    if (!password_verify($password, $currentPassword)) {
                        exit("Invalid current password!");
                    }
                }
            }
        } else {
            echo "Something went wrong! Please retry.";
        }
        mysqli_stmt_close($stmt);
    }
}

function updatePassword($link, $newHash, $email) {
    $query = "UPDATE users SET password=? WHERE email=?";
    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to params
        mysqli_stmt_bind_param($stmt, "ss", $newHash, $email);
        //attempt to execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            echo "<h1>Something went wrong! Please retry!</h1>";
        }
        mysqli_stmt_close($stmt);
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
        mysqli_stmt_close($stmt);
    }
}
        

if (isset($_POST['newData']) && !empty($_POST['oldPassword']) || !empty($_POST['newEmail'])) {                                                   
    //connect to database, in case of failure give error
    $link = mysqli_connect($server, $user, $password, $database);
    if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

    $oldPassword = $_POST['oldPassword'];
    if (isset($oldPassword) && !empty($oldPassword)) {
        verifyPassword($link, $_SESSION['email'], $oldPassword);
        $oldHash = password_hash($oldPassword, PASSWORD_DEFAULT);

        $password = $_POST['newPassword'];
        if (!empty($oldPassword) && isset($password) && !empty($password)) {
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

        $newHash = password_hash($cpassword, PASSWORD_DEFAULT);
        updatePassword($link, $newHash, $_SESSION['email']);
    }

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
