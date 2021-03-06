<?php 
require_once("../sessionstart.php");
require_once("validateUserCredentials.php");
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <title>User's credentials</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/showHidePwd.js"></script>
</head>
<body>
    <header>                                                                
        <img class="logo" src="../img/JAMLogo.png" alt="Company logo">                         
        <nav>                                                               
            <a href="employee.php">Back to user page</a>
        </nav>                                                              
    </header>
    <h1>Your credentials:</h1>
    <h3>User's title: <?php echo $_SESSION['title'];?></h3>
    <h3>User's name: <?php echo $_SESSION['name'];?></h3>
    <h3>User's email: <?php echo $_SESSION['email'];?></h3><br>
    <h1 style="text-align:center;">Update your credentials:</h1>
    <form method="POST" action="#" style="padding: 5px;
        border: 1px solid;">
        <label for="oldPassword"><b>Current password:</b></label>
        <input type="password" id="oldPassword" placeholder="Password" name="oldPassword"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
        <span onmouseenter="showoPwd()" onmouseleave="hideoPwd()" >?</span><br>
        <label for="newPassword"><b>Change your password:</b></label>
        <input type="password" id="newPassword" placeholder="Password" name="newPassword" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
        <span onmouseenter="showPwd()" onmouseleave="hidePwd()" >?</span><br>
        <label for="confirmPassword"><b>Confirm your password:</b></label>
        <input type="password" id="confirmPassword" placeholder="Password" name="newcPassword"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
        <span onmouseenter="showcPwd()" onmouseleave="hidecPwd()" >?</span>
        <p>NB: Password must have at least 8 characters and at least one number, 
            one uppercase letter and one lowercase letter</p>
        <label for="newEmail"><b>Change your email:</b></label>
        <input type="email" id="newEmail" name="newEmail" placeholder="Email"><br><br>
        <input type="submit" name="newData" class="registerButton" value="Update your data">
    </form>
    <footer id="footor" style=" margin-top: 200px; margin-bottom: 0px;">
        <h2>Contact JAM</h2>
        <p id="email">Send us an email to:<br><a href="mailto:fake@mail.com">info@JAM.com</a> </p>
        <p id="number">Call us to:<br><a href="tel:+37255555555">+372 5555 5555</a> </p>
    </footer>
</body>
</html>
