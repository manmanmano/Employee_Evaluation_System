<?php
session_name("Evaluation");
session_set_cookie_params(['path' => '/~juprus/icd0007_project/']);                                                                  
session_start();
echo session.save_path();
require_once("employertable.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Employer</title>
        <link rel="stylesheet" href="../styles/style.css">
    </head>
    <body>
        <header>
            <img class="logo" src="../img/JAMLogo.png">
            <nav>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="submit" name="logout" value="Log out">
                    <input type="submit" name="newevaluation" value="Add new evaluation">
                </form>
            </nav>
        </header>
        <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
            <label for="week">Week:</label>
            <input type="date" id="date" name="date"><br>
            <label for="name">Name:</label>
            <select id="name" name="name">
                <option value=0>Please select an employee</option>
                <?php
                createNames();
                ?>
            </select><br>
            <input type="submit" name="search" value="Search"><br>
        </form><br>
        <table>
            <tr>
                <th>Name</th>
                <th>Week</th>
                <th>Evaluation</th>
            </tr>
            <?php
            createTable();
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
    header("refresh:0; url=../index.php");
}
if (isset($_POST['newevaluation'])) {
    header("refresh:0; url=employerInput.php");
}
?>
