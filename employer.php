<?php
session_name();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Employer</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <header>
            <img class="logo" src="img/JAMLogo.png">
            <nav>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <input type="submit" name="logout" value="Log out">
                    <input type="submit" name="newevaluation" value="Add new evaluation">
                </form>
            </nav>
        </header>
        <form method="POST" action="<?=$_SERVER['PHP_SELF']?>">
            <label for="week">Week:</label>
            <input type="week" id="week" name="week">
            <input type="submit" name="searchbyweek" value="Search"><br>
            <label for="name">Name:</label>
            <select id="name" name="name">
                <?php
                $names = ['John Smith', 'Mary Jane', 'James Doe'];
                for ($i = 0; $i < sizeof($names); $i++) {
                    echo "<option value=", $names[$i], ">", $names[$i], "</option>";
                }
                ?>
            </select>
            <input type="submit" name="searchbyname" value="Search"><br>
        </form><br>
        <table>
            <tr>
                <th>Name</th>
                <th>Week</th>
                <th>Evaluation</th>
            </tr>
            <?php
            $employees = array(
                'John Smith' => array(5 => 4.5, 6 => 3.9, 7 => 2.9),
                'Mary Jane' => array(5 => 3.7, 6 => 4.3, 7 => 4.4),
                'James Doe' => array(5 => 2.5, 6 => 3.5, 7 => 4.9),
            );
            if (isset($_POST['searchbyweek']) && intval(substr($_POST['week'], 6, 2)) != 0) {
                $week = intval(substr($_POST['week'], 6, 2));
                foreach ($employees as $name => $grades) {
                    if (!empty($grades[$week])) {
                        echo "<tr>";
                        echo "<td>", $name, "</td>";
                        echo "<td>", $week, "</td>";
                        echo "<td><a href='grade popup'>", $grades[$week], "</a></td>";
                        echo "</tr>";
                    }
                }
            } elseif (isset($_POST['searchbyname'])) {
                $name = $_POST['name'];
                echo $name;
                foreach ($grades[$name] as $week => $grade) {
                    echo "<tr>";
                    echo "<td>", $name, "</td>";
                    echo "<td>", $week, "</td>";
                    echo "<td><a href='grade popup'>", $grade, "</a></td>";
                    echo "</tr>";
                }
            } else {
                foreach ($employees as $name => $grades) {
                    foreach ($grades as $week => $grade) {
                        echo "<tr>";
                        echo "<td>", $name, "</td>";
                        echo "<td>", $week, "</td>";
                        echo "<td><a href='grade popup'>", $grade, "</a></td>";
                        echo "</tr>";
                    }
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
if (isset($_POST['newevaluation'])) {
    header("refresh:0; url=employerinput.php");
}
?>
