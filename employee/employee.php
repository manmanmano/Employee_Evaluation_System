<?php
require_once("employeetable.php");
getGrade("initiative", $_SESSION['token']);
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
                alert("Employee shows strong initiative: " . <?php getGrade("initiative", $_SESSION['token']) ?> . "\nEmployee works well with others in group-based projects: "  . <?php getGrade("group_based_projects", $_SESSION['token']) ?> . "\nEmployee takes instructions and follows leaders well: " . <?php getGrade("follows_instructions", $_SESSION['token']) ?> . "\nEmployee shows good leadership skills: "  . <?php getGrade("leadership", $_SESSION['token']) ?> . "\nEmployee stays focused on tasks at hand: "  . <?php getGrade("focused", $_SESSION['token']) ?> . "\nEmployee knows how to prioritize tasks: "  . <?php getGrade("prioritize", $_SESSION['token']) ?> . "\nEmployee has good communication with coworkers: "  . <?php getGrade("communication_coworkers", $_SESSION['token']) ?> . "\nEmployee has good communication with superiors: "  . <?php getGrade("communication_superiors", $_SESSION['token']) ?> . "\nEmployee is dependable: "  . <?php getGrade("dependable", $_SESSION['token']) ?> . "\nEmployee gets assignments in on time: "  . <?php getGrade("assignments_on_time", $_SESSION['token']) ?> . "\nEmployee arrives on time every day: "   . <?php getGrade("arrives_on_time", $_SESSION['token']) ?> . "\nEmployee's work is of high quality: "  . <?php getGrade("quality", $_SESSION['token']) ?> . "\n");
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
