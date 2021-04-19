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
                alert("Employee shows strong initiative " . $grade . "\n"
                    Employee works well with others in group-based projects "  . $grade . "\n"
                    Employee takes instructions and follows leaders well " . $grade . "\n"
                    Employee shows good leadership skills "  . $grade . "\n"
                    Employee stays focused on tasks at hand "  . $grade . "\n"
                    Employee knows how to prioritize tasks "  . $grade . "\n"
                    Employee has good communication with coworkers "  . $grade . "\n"
                    Employee has good communication with superiors "  . $grade . "\n"
                    Employee is dependable "  . $grade . "\n"
                    Employee gets assignments in on time "  . $grade . "\n"
                    Employee arrives on time every day "   . $grade . "\n"
                    Employee's work is of high quality "  . $grade . "\n"
                ");
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
