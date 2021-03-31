<?php
session_name();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>(username) evaluation</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
		<header>
            <img class="logo" src="img/JAMLogo.png">
			<nav>
				<form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
                    <input type="submit" name="logout" value="Log out">
                </form>
			</nav>
		</header>
		<h1>My evaluation</h1>
        <form>
            <label for="week">Week:</label>
            <input type="week" >
        </form>
        <table>
            <tr>
                <th>Week</th>
                <th>Evaluation</th>
            </tr>
            <tr>
                <td>01.02.21-07.02.21</td>
                <td><a href="grade popup">4.5</a></td>
            </tr>
            <tr>
                <td>08.02.21-14.02.21</td>
                <td><a href="grade popup">3.9</a></td>
            </tr>
            <tr>
                <td>15.02.21-21.02.21</td>
                <td><a href="grade popup">2.9</a></td>
            </tr>
            <tr>
        </table>
         <footer>
            <h3>Contact JAM</h3>
            <p>
                Send us an email to:<br><a href="mailto: fake@mail.com">info@JAM.com</a>
                <br><br>
                Call us to:<br><a href="tel: +372 5555 5555">+372 5555 5555</a>
            </p>
        </footer>

    </body>
</html>

<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("refresh:0; url=index.php");
}
?>
