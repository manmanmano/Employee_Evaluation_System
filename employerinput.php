<?php
if (isset($_POST['submit'])) {

    $names = $_POST['worker_name'];
    if (isset($names) && ($names != "james" || $names != "mary" || $names != "john")) {
        die("Invalid worker name set!");
    }



    $initiative = $_POST['initiative'];
    if (!isset($initiative)) {                                                       
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($initiative != 1 && $initiative != 5) {                     
            die("Corrupted data in radio input!");                              
        }                                                                       
    }
    
    $gbProjects = $_POST['group_based_projects'];
    if (!isset($gbProjects)) {                                                      
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($gbProjects != 1 && $gbProjects != 5) {                                
            die("Corrupted data in radio input!");                                 
        }                                                                          
    }

    $follows = $_POST['follows_instructions'];
    if (!isset($follows)) {
        die("Radio button left blank!");
    } else {
        if ($follows != 1 && $follows != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $leadership = $_POST['leadership'];
    if (!isset($leadership)) {
        die("Radio button left blank!");
    } else {
        if ($leadership != 1 && $leadership != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $focused = $_POST['focused'];
    if (!isset($focused)) {
        die("Radio button left blank!");
    } else {
        if ($focused != 1 && $focused != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $prioritize = $_POST['prioritize'];
    if (!isset($prioritize)) {
        die("Radio button left blank!");
    } else {
        if ($prioritize != 1 && $prioritize != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $workers = $_POST['communication_coworkers'];
    if (!isset($workers)) {
        die("Radio button left blank!");
    } else {
        if ($workers != 1 && $workers != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $superiors = $_POST['communication_superiors'];
    if (!isset($superiors)) {
        die("Radio button left blank!");
    } else {
        if ($superiors != 1 && $superiors != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $dependable = $_POST['dependable'];
    if (!isset($dependable)) {
        die("Radio button left blank!");
    } else {
        if ($dependable != 1 && $dependable != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $punctualAss = $_POST['assignments_on_time'];
    if (!isset($punctualAss)) {
        die("Radio button left blank!");
    } else {
        if ($punctualAss != 1 && $punctualAss != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $punctualTime = $_POST['arrives_on_time'];
    if (!isset($punctualTime)) {
        die("Radio button left blank!");
    } else {
        if ($punctualTime != 1 && $punctualTime != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $quality = $_POST['quality'];
    if (!isset($quality)) {
        die("Radio button left blank!");
    } else {
        if ($quality != 1 && $quality != 5) {
            die("Corrupted data in radio input!");
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add new evaluation</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <header>
            <img class="logo" src="img/JAMLogo.png">
            <nav>
                <a href="employer.php">Back to user page</a>
            </nav>
        </header>
        <form action="employer.php" method="POST" name="updateEval">
        <table>
            <tr>
                Name:
                <select name="worker_name" required>
                    <option value="john">John Smith</option>
                    <option value="mary">Mary Jane</option>
                    <option value="james">James Doe</option>
                </select>
                Week:
                <input type="date" name="date" value"<?php echo date("Y-m-d"); ?>"
                    max="<?php echo date('Y-m-d');?>" 
                    min="<?php echo date('Y-m-d', strtotime($date . ' - 3 weeks')) ?>">
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
