<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Main page for employee performance evaluation system">
    <title>Index</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Employee perfomance evaluation</h1>
    <p>
        Welcome to JAM's most precious invention: the "Employee performance evaluation" system.<br>
        
    </p>
    <div id= "floating-login">
        <h2>Welcome!</h2>
        <label>Login as:</label>
        <input type="radio" value="employer" name="level">
        <label>Employer</label>
        <input type="radio" value="employee" name="level">
        <label>Employee</label>
        <br><br>
        <input type="text" name="username" placeholder="Email" autocomplete="off" required="">
        <br><br>
        <input type="password" name="password" placeholder="Password" autocomplete="off" required="">
        <br><br>
        <input type="submit" value="submit">
        <p>Not registered? Do it <a href="register.html">now</a>!</p>
    </div>
    <p> 
        The purpose of this website is to provide employers with an efficient and easy to use tool that evaluates the performance of their employers.<br>
        Do you want to keep track of the performance of your employees over the time or just let them know how they are doing?<br>
        Then the "Employee Performance Evaluation" system is what you are looking for!
    </p>
    <h2>How does it look like?</h2>
    <p>
        Employees will find their evaluated performance once they are logged in. <br>
        They will also have the possibility to compare their current evaluations with older ones by just scrolling down their page.<br>
        Doing so employees will always have the chance to compare different results from different times and eventually work on improving themselves.
    </p>
    <img src="img/employeeTAB.png" alt="Image of employee screen" title="Look of the employee page">
    <p>
        Employers can either analyze their employees previous performances or add new ones.<br>
        The new performance will be added on top of the older ones, while the others will be visibile by just scrolling down the page.<br>
        This system will help employers to monitor and update their employees performances with relative ease and ina short period of time.
    </p>
    <img src="img/employerTAB.png" alt="Image of employer screen" title="Look of the employer page">
    <h2>The team</h2>
    <p>To make this program possible JAM put together the smartest minds on earth.<br>These people have worked day and night to
        deliver the user the perfect website: secure, fast, and efficient.<br>The team is conducted by three Cyber Security Engineering students at TalTech.</p>
    <p>The main members of the team are:</p>
        <ul>
            <li>Jan Markus Üprus</li>
            <li>Andre Tomingas</li>
            <li>Mariano D'Angelo</li>
        </ul>
        <p></p>
    <footer id="foot">
        <h3>Contact JAM</h3>
        <p id="email">Send us an email to:<br><a href="mailto: fake@mail.com">info@JAM.com</a> </p>
        <p id="number">Call us to:<br><a href="tel: +372 5555 5555">+372 5555 5555</a> </p>
    </footer>
</body> 
</html>