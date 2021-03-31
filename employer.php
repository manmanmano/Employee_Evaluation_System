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
        <form>
            <label for="week">Week:</label>
            <input type="week" id="week" name="week">
            <input type="submit" name="filter" value="Filter">
            <label for="employee"
            <select name="employee">
                <option>John Smith</option>
                <option>Mary Jane</option>
                <option>James Doe</option>
            </select>
        </form>
        <table>
            <tr>
                <th>Name</th>
                <th>Week</th>
                <th>Evaluation</th>
            </tr>
            <tr>
                <td>John Smith</td>
                <td>01.02.21-07.02.21</td>
                <td><a href="grade popup">4.5</a></td>
            </tr>
            <tr>
                <td>Mary Jane</td>
                <td>01.02.21-07.02.21</td>
                <td><a href="grade popup">3.7</a></td>
            </tr>
            <tr>
                <td>James Doe</td>
                <td>01.02.21-07.02.21</td>
                <td><a href="grade popup">2.5</a></td>
            </tr>
            <tr>
                <td>John Smith</td>
                <td>08.02.21-14.02.21</td>
                <td><a href="grade popup">3.9</a></td>
            </tr>
            <tr>
                <td>Mary Jane</td>
                <td>08.02.21-14.02.21</td>
                <td><a href="grade popup">4.3</a></td>
            </tr>
            <tr>
                <td>James Doe</td>
                <td>08.02.21-14.02.21</td>
                <td><a href="grade popup">3.5</a></td>
            </tr>
            <tr>
                <td>John Smith</td>
                <td>15.02.21-21.02.21</td>
                <td><a href="grade popup">2.9</a></td>
            </tr>
            <tr>
                <td>Mary Jane</td>
                <td>15.02.21-21.02.21</td>
                <td><a href="grade popup">4.4</a></td>
            </tr>
            <tr>
                <td>James Doe</td>
                <td>15.02.21-21.02.21</td>
                <td><a href="grade popup">4.9</a></td>
            </tr>
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
