<?php
require_once("employeetable.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $_SESSION['name']; ?> evaluation</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
		<header>
            <img class="logo" src="../img/JAMLogo.png">
			<nav>
				<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <input type="submit" name="logout" value="Log out">
                </form>
			</nav>
		</header>
        <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
        <form method="GET" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label for="date">Week:</label>
            <input type="date" id="date" name="date">
            <input type="submit" name="search" value="Search">
        </form><br>
        <table>
            <tr>
                <th>Week</th>
                <th>Year</th>
                <th>Evaluation</th>
            </tr>
            <?php
            require_once("../sessionstart.php");
            createTable($_SESSION['token']);
            ?>
        </table>
        <script>
            function modal() {
                alert("Employee shows strong initiative: " + "\nEmployee works well with others in group-based projects: " + "\nEmployee takes instructions and follows leaders well: " + "\nEmployee shows good leadership skills: " + "\nEmployee stays focused on tasks at hand: " + "\nEmployee knows how to prioritize tasks: " + "\nEmployee has good communication with coworkers: " + "\nEmployee has good communication with superiors: " + "\nEmployee is dependable: " + "\nEmployee gets assignments in on time: " + "\nEmployee arrives on time every day: " + "\nEmployee's work is of high quality: " + "\n"");
            }
        </script>
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
    header("refresh:0; url=../index.php");
}
?>
