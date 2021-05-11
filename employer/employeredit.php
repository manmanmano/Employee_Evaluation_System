<?php
require_once("../sessionstart.php");
require_once("employereditvalidation.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Edit evaluation</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
        <header>
            <img class="logo" src="../img/JAMLogo.png">
            <nav>
                <a href="employer.php">Back to user page</a>
            </nav>
        </header>
        <form action="employereditvalidation.php" method="POST" name="updateEval">
        <table class="evaluationTable">
            <tr>
                Name:
                <?php setcookie("name", $_GET['name'], time() + 3600, "/~madang/icd0007_project"); echo $_GET['name']; ?>
                Week:
                <?php setcookie("week", $_GET['week'], time() + 3600, "/~madang/icd0007_project"); echo $_GET['week']; ?>
                Year:
                <?php setcookie("year", $_GET['year'], time() + 3600, "/~madang/icd0007_project"); echo $_GET['year']; ?>
            </tr>
            <?php require_once("radioButtons.php") ?>
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
