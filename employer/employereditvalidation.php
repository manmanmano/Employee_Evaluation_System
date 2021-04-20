<?php
require_once("../sessionstart.php");
include_once("../usersData/connect.db.php");

function validateRadio($input) {
    if (!isset($input) || empty($input)) {                            
        die("Radio button left blank!");
    } else {                                                                    
        if ($input < 1 || $input > 5) {                               
            die("Corrupted data in radio input!");                              
        }                                                                       
    } 
}

function evaluateEmployee($arr) {
    return array_sum($arr) / count($arr);
}

function editEval($link, $token, $name, $week, $year, $average, $initiative, $gbProjects, 
    $follows, $leadership, $focused, $prioritize, $workers, $superiors, $dependable, 
    $punctualAss, $punctualTime, $quality) {

    $query = "UPDATE token_" . $token . "
        SET average=" . $average . ", initiative=" . $initiative . ", group_based_projects=" . $gbProjects . ", follows_instructions=" . $follows . ",
        leadership=" . $leadership . ", focused=" . $focused . ", prioritize=" . $prioritize . ", communication_coworkers=" . $workers . ", communication_superiors=" . $superiors . ", dependable=" . $dependable . ", assignments_on_time=" . $punctualAss . ", arrives_on_time=" . $punctualTime . ", quality=" . $quality . " WHERE name=" . $name . " AND week=" . $week . " AND year=" . $year . ";";

    $result = mysqli_query($link, $query);
    mysqli_close($link);
    echo $query;
    #header("refresh:5;url=employer.php");
}

if ($_SESSION['title'] != 'employer') {
    die("Session expired!");
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

if (isset($_POST['submit'])) {         
    require_once("../usersData/sanitizeInputVar.php");                                                              
                                                                            
    $workerName = sanitizeInputVar($link, $_COOKIE['name']);
    $week = sanitizeInputVar($link, $_COOKIE['week']);
    $year = sanitizeInputVar($link, $_COOKIE['year']);
    echo $workerName;
    echo $week;
    echo $year;                                                                                          
                                                                      
    $initiative = $_POST['initiative'];                                         
    $gbProjects = $_POST['group_based_projects'];                               
    $follows = $_POST['follows_instructions'];                                  
    $leadership = $_POST['leadership'];                                         
    $focused = $_POST['focused'];                                               
    $prioritize = $_POST['prioritize'];                                         
    $workers = $_POST['communication_coworkers'];                               
    $superiors = $_POST['communication_superiors'];                             
    $dependable = $_POST['dependable'];                                         
    $punctualAss = $_POST['assignments_on_time'];                              
    $punctualTime = $_POST['arrives_on_time'];                                  
    $quality = $_POST['quality'];                                               

    $attrArr = [                                                                
        $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize,  
        $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality
    ];

    foreach ($attrArr as $attr) {
        validateRadio($attr);
    }
 
    $average = round(evaluateEmployee($attrArr), 1);                            

    editEval($link, $_SESSION['token'], $workerName, $week, $year, $average, 
        $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize, 
        $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality);

    mysqli_close($link);
}
?>

