<?php 
require_once("../sessionstart.php");
require_once("../usersData/connect.db.php");

// checks if password and cPassword match
function matching_passwords($password, $cpassword)
{
    if ($password != $cpassword) {
        // error matching passwords
        header("refresh:2;url=userCredentials.php");
        exit('<h1>Your passwords do not match.');
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
                        header("refresh:2;url=userCredentials.php");
                        exit("<h1>Invalid current password!");
                    }
                }
            }
        } else {
            echo "<h1>Something went wrong! Please retry.";
            header("refresh:2;url=userCredentials.php");
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
//update the email 
function updateEmail($link, $email, $oldEmail) {
    $query = "UPDATE users SET email=? WHERE email=?";
    //prepare the statement
    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to params
        mysqli_stmt_bind_param($stmt, "ss", $email, $oldEmail);
        //attempt to execute the statement
        if (!mysqli_stmt_execute($stmt)) {
            echo "<h1>Something went wrong! Please retry!</h1>";
            header("refresh:2;url=userCredentials.php");
        }
        //close the statement
        mysqli_stmt_close($stmt);
    }
}
        
//if submit is set and at least one input field is set execute the script
if (isset($_POST['newData']) && !empty($_POST['oldPassword']) || !empty($_POST['newEmail'])) {                                                   
    //connect to database, in case of failure give error
    $link = mysqli_connect($server, $user, $password, $database);
    if (!$link) die("Connection to DB failed: " . mysqli_connect_error());
    
    $oldPassword = $_POST['oldPassword'];
    //if the old password is set and it is not empty than check for the other passwords as well
    if (isset($oldPassword) && !empty($oldPassword)) {
        //verify the password from the database. If it is correct continue
        verifyPassword($link, $_SESSION['email'], $oldPassword);
        //hash teh old password
        $oldHash = password_hash($oldPassword, PASSWORD_DEFAULT);

        $password = $_POST['newPassword'];
        //if the oldPassword is not empty and the new password is set and not empty 
        //check for the validity
        if (!empty($oldPassword) && isset($password) && !empty($password)) {
            if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
                header("refresh:2;url=userCredentials.php");
                exit("<h1>Invalid password");
            }
        }

        $cpassword = $_POST['newcPassword'];
        // if the new password is not empty and the confirm password is set and not empty
        // check for the validity
        if (!empty($password) && isset($cpassword) && !empty($cpassword)) {
            if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $cpassword)) {
                header("refresh:2;url=userCredentials.php");
                exit("<h1>Invalid password");
            }
        }
        //find if the confirm password and new password match
        matching_passwords($password, $cpassword);
        //hash the new password
        $newHash = password_hash($cpassword, PASSWORD_DEFAULT);
        //update the new password
        updatePassword($link, $newHash, $_SESSION['email']);
    }

    $email = $_POST['newEmail'];
    //if the email is set and it is not empty
    if (isset($email) && !empty($email)) {
        //validate the email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("refresh:2;url=userCredentials.php");
            exit("<h1>Invalid email");
        } else {
            //if the email does not exist in the table of the users than update it 
           $bool =  checkEmail($link, $email);
           if ($bool == true) {
               updateEmail($link, $email, $_SESSION['email']);
               $_SESSION['email'] = $email;
           }
        }
    }

    //close the statement
    mysqli_close($link);
    //redirect to updateSuccess
    header("refresh:0; updateSuccess.php");
}

?>
