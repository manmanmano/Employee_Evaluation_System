<?php
require_once("sessionstart.php");
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Main page for employee performance evaluation system">
    <title>Index</title>
    <link rel="stylesheet" href="styles/style.css">
 	<script src="scripts/showHidePwd.js"></script>
</head>
<body>
   <header>
        <img class="logo" src="img/JAMLogo.png" alt="Logo of the company">
        <nav>
            <a href="#look">Overview</a>
            <a href="#team">About the team</a>
            <a href="#contact">Contact us</a>
            <a href="#floating-login">Login</a>
        </nav>
    </header>
    <h1>Employee perfomance evaluation</h1>
    <p>
        Welcome to JAM's most precious invention: the "Employee performance evaluation" system.<br>
    </p>
    <div id= "floating-login">
        <h2>Welcome!</h2>
        <form action="indexValidation/indexValidator.php" method="POST" name="loginForm">
            <label>Login as:</label>
            <input type="radio" name="title" value="employer" required>
            <label>Employer</label>
            <input type="radio" name="title" value="employee" required>
            <label>Employee</label>
            <br><br>
            <input type="email" name="email" placeholder="Email" autocomplete="off" required="">
            <br><br>
            <input type="password" name="password" id="password" placeholder="Password" minlength="8" autocomplete="off" required="">
            <!--reveal password on hover-->
            <span id="reveal-pwd" onmouseenter="showPwd()" onmouseleave="hidePwd()" >?</span>
            <br><br>
            <input type="submit" value="Login" name="submit" class="registerButton">
            <!--echo error message if any-->
            <?php echo $credentialError; ?>
            <!--hyperlink to registration form-->
            <p>Not registered? Do it <a href="register/register.php">now</a>!</p>
        </form>
    </div>
    <!--topFunction is used to allow the user to scrollback from the bottom of the page-->
    <button onclick="topFunction()" id="myBtn" title="Go tot top">Top</button>
    <script src="scripts/scrollBack.js"></script>
    <p> 
        The purpose of this website is to provide employers with an efficient and easy to use tool that evaluates the performance of their employers.<br>
        Do you want to keep track of the performance of your employees over the time or just let them know how they are doing?<br>
        Then the "Employee Performance Evaluation" system is what you are looking for!
    </p>
    <h2 id="look">How does it look like?</h2>
    <p>
        Employees will find their evaluated performance once they are logged in. <br>
        They will also have the possibility to compare their current evaluations with older ones by just scrolling down their page.<br> 
        In case the employee wishes, he can sort his/her evaluations by year<br>
        Doing so employees will always have the chance to compare different results from different times and eventually work on improving themselves.
    </p>
    <img src="img/employeeTAB.png" alt="Image of employee screen" title="Look of the employee page">
    <p>
        Employers can either analyze their employees previous performances and either add new ones or remove/edit old ones.<br>
        The new performance will be added on top of the older ones, while the others will be visibile by just scrolling down the page.<br>
        In case the employer wishes, he/she can sort his/her employees' evaluations by either year, name, or both.<br>
        This system will help employers to monitor and update their employees performances with relative ease and ina short period of time.
    </p>
    <img src="img/employerTAB.png" alt="Image of employer screen" title="Look of the employer page">
    <h2 id="team">The team</h2>
    <p>To make this program possible JAM put together the smartest minds on earth.<br>These people have worked day and night to
        deliver the user the perfect website: secure, fast, and efficient.<br>The team is conducted by three Cyber Security Engineering students at TalTech.</p>
    <p>The main members of the team are:</p>
        <ul>
            <li>Jan Markus Üprus</li>
            <li>Andre Tomingas</li>
            <li>Mariano D'Angelo</li>
        </ul>
    <footer id="foot">
        <h3 id="contact">Contact JAM</h3>
        <p id="email">Send us an email to:<br><a href="mailto:madang@taltech.ee">info@JAM.com</a> </p>
        <p id="number">Call us to:<br><a href="tel:+37255555555">+372 5555 5555</a> </p>
    </footer>
</body> 
</html>
