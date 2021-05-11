<?php
require_once("../sessionstart.php");
require_once("employerInputValidation.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add new evaluation</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
        <header>
            <img class="logo" src="../img/JAMLogo.png">
            <nav>
                <a href="employer.php">Back to user page</a>
            </nav>
        </header>
        <form action="employerInputValidation.php" method="POST" name="updateEval">
                <label for="name">Name:</label>
                <select name="worker_name" required>
                    <?php
                    require_once("../sessionstart.php");
                    createNames($_SESSION['token'], $link);
                    ?>
                </select><br>
                <label for="date">Week:</label>
                <input type="date" name="date" id="date" required><br>
                <table class="evaluationTable"><br>
                <?php require_once("radioButtons.php") ?>
                <td><input type="submit" name="submit"></td>
                </table>
        </form>
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
