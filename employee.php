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
				<form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <input type="submit" name="logout" value="Log out">
                </form>
			</nav>
		</header>
		<h1>My evaluation</h1>
        <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label for="week">Week:</label>
            <input type="week" id="week" name="week">
            <input type="submit" name="search" value="Search">
        </form><br>
        <table>
            <tr>
                <th>Week</th>
                <th>Evaluation</th>
            </tr>
            <?php
            $grades = array(5 => 4.5, 6 => 3.9, 7 => 2.9);
            if (isset($_POST['search']) && intval(substr($_POST['week'], 6, 2)) != 0) {
                $week = intval(substr($_POST['week'], 6, 2));
                echo "<tr>";
                echo "<td>", $week, "<td>";
                echo "<td><a href='grade popup'>", $grades[$week], "</a></td>";
                echo "</tr>";
            } else {
                foreach ($grades as $week => $grade) {
                    echo "<tr>";
                    echo "<td>", $week, "</td>";
                    echo "<td><a href='grade popup'>", $grade, "</a></td>";
                    echo "</tr>";
                }
            }
            ?>
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
