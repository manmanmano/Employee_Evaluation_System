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
        <table>
            <tr>
                Name:
                <select name="worker_name" required>
                    <?php
                    require_once("../sessionstart.php");
                    createNames($_SESSION['token'], $link);
                    ?>
                </select>
                Week:
                <input type="date" name="date" id="date" required>
            </tr>
            <tr>
                <th>Performance</th>
                <th>Never</th>
                <th>Rarely</th>
                <th>Sometimes</th>
                <th>Mostly</th>
                <th>Always</th>
            </tr>
            <tr>
                <td>Employee shows strong initiative</td>
                <td><input type="radio" name="initiative" value="1" required></td>
                <td><input type="radio" name="initiative" value="2"></td>
                <td><input type="radio" name="initiative" value="3"></td>
                <td><input type="radio" name="initiative" value="4"></td>
                <td><input type="radio" name="initiative" value="5"></td>
            </tr>
            <tr>
                <td>Employee works well with others in group-based projects</td>
                <td><input type="radio" name="group_based_projects" value="1" required></td>
                <td><input type="radio" name="group_based_projects" value="2"></td>
                <td><input type="radio" name="group_based_projects" value="3"></td>
                <td><input type="radio" name="group_based_projects" value="4"></td>
                <td><input type="radio" name="group_based_projects" value="5"></td>
            </tr>
            <tr>
                <td>Employee takes instructions and follows leaders well</td>
                <td><input type="radio" name="follows_instructions" value="1" required></td>
                <td><input type="radio" name="follows_instructions" value="2"></td>
                <td><input type="radio" name="follows_instructions" value="3"></td>
                <td><input type="radio" name="follows_instructions" value="4"></td>
                <td><input type="radio" name="follows_instructions" value="5"></td>
            </tr>
            <tr>
                <td>Employee shows good leadership skills</td>
                <td><input type="radio" name="leadership" value="1" required></td>
                <td><input type="radio" name="leadership" value="2"></td>
                <td><input type="radio" name="leadership" value="3"></td>
                <td><input type="radio" name="leadership" value="4"></td>
                <td><input type="radio" name="leadership" value="5"></td>
            </tr>
            <tr>
                <td>Employee stays focused on tasks at hand</td>
                <td><input type="radio" name="focused" value="1" required></td>
                <td><input type="radio" name="focused" value="2"></td>
                <td><input type="radio" name="focused" value="3"></td>
                <td><input type="radio" name="focused" value="4"></td>
                <td><input type="radio" name="focused" value="5"></td>
            </tr>
            <tr>
                <td>Employee knows how to prioritize tasks</td>
                <td><input type="radio" name="prioritize" value="1" required></td>
                <td><input type="radio" name="prioritize" value="2"></td>
                <td><input type="radio" name="prioritize" value="3"></td>
                <td><input type="radio" name="prioritize" value="4"></td>
                <td><input type="radio" name="prioritize" value="5"></td>
            </tr>
            <tr>
                <td>Employee has good communication with coworkers</td>
                <td><input type="radio" name="communication_coworkers" value="1" required></td>
                <td><input type="radio" name="communication_coworkers" value="2"></td>
                <td><input type="radio" name="communication_coworkers" value="3"></td>
                <td><input type="radio" name="communication_coworkers" value="4"></td>
                <td><input type="radio" name="communication_coworkers" value="5"></td>
            </tr>
            <tr>
                <td>Employee has good communication with superiors</td>
                <td><input type="radio" name="communication_superiors" value="1" required></td>
                <td><input type="radio" name="communication_superiors" value="2"></td>
                <td><input type="radio" name="communication_superiors" value="3"></td>
                <td><input type="radio" name="communication_superiors" value="4"></td>
                <td><input type="radio" name="communication_superiors" value="5"></td>
            </tr>
            <tr>
                <td>Employee is dependable</td>
                <td><input type="radio" name="dependable" value="1" required></td>
                <td><input type="radio" name="dependable" value="2"></td>
                <td><input type="radio" name="dependable" value="3"></td>
                <td><input type="radio" name="dependable" value="4"></td>
                <td><input type="radio" name="dependable" value="5"></td>
            </tr>
            <tr>
                <td>Employee gets assignments in on time</td>
                <td><input type="radio" name="assignments_on_time" value="1" required></td>
                <td><input type="radio" name="assignments_on_time" value="2"></td>
                <td><input type="radio" name="assignments_on_time" value="3"></td>
                <td><input type="radio" name="assignments_on_time" value="4"></td>
                <td><input type="radio" name="assignments_on_time" value="5"></td>
            </tr>
            <tr>
                <td>Employee arrives on time every day</td>
                <td><input type="radio" name="arrives_on_time" value="1" required></td>
                <td><input type="radio" name="arrives_on_time" value="2"></td>
                <td><input type="radio" name="arrives_on_time" value="3"></td>
                <td><input type="radio" name="arrives_on_time" value="4"></td>
                <td><input type="radio" name="arrives_on_time" value="5"></td>
            </tr>
            <tr>
                <td>Employee's work is of high quality</td>
                <td><input type="radio" name="quality" value="1" required></td>
                <td><input type="radio" name="quality" value="2"></td>
                <td><input type="radio" name="quality" value="3"></td>
                <td><input type="radio" name="quality" value="4"></td>
                <td><input type="radio" name="quality" value="5"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit"></td>
            </tr>
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
