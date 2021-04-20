<?php 
require_once("../sessionstart.php");
?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <title>Employee's credentials</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <h3>Employee's name: <?php echo $_SESSION['name'];?></h3>
    <h3>Employee's email: <?php echo $_SESSION['email']; ?></h3>
    <footer id="footor">
        <h2>Contact JAM</h3>
        <p id="email">Send us an email to:<br><a href="mailto: fake@mail.com">info@JAM.com</a> </p>
        <p id="number">Call us to:<br><a href="tel: +372 5555 5555">+372 5555 5555</a> </p>
    </footer>
</body>
</html>
