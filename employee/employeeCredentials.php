<?php 
require_once("../sessionstart.php");
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <title>User's credentials</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <header>                                                                
        <img class="logo" src="../img/JAMLogo.png">                         
        <nav>                                                               
            <a href="employee.php">Back to user page</a>
        </nav>                                                              
    </header>
    <h2>Your credentials:</h2>
    <h4>User's title: <?php echo $_SESSION['title'];?></h4>
    <h4>User's name: <?php echo $_SESSION['name'];?></h4>
    <h4>User's email: <?php echo $_SESSION['email'];?></h4>
    <h2>Update your credentials:</h2>
    <form method="POST" method="validateEmployeeCredentials.php" style="padding: 5px;
        border: 1px solid;">
        <label for="newPassword"><b>Change your password:</b></label>
        <input type="password" placeholder="Password" name="newPassword" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
        <p>NB: Password must have at least 8 characters and at least one number, 
            one uppercase letter and one lowercase letter</p>
        <label for="newEmail"><b>Change your email:</b></label>
        <input type="email" name="newEmail" placeholder="Email"><br><br>
        <input type="submit" name="newData" value="Update your data">
    </form>
    <footer id="footor" style=" margin-top: 200px; margin-bottom: 0px;">
        <h2>Contact JAM</h2>
        <p id="email">Send us an email to:<br><a href="mailto: fake@mail.com">info@JAM.com</a> </p>
        <p id="number">Call us to:<br><a href="tel: +372 5555 5555">+372 5555 5555</a> </p>
    </footer>
</body>
</html>
