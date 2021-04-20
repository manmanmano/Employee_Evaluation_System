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
        SET average=?, initiative=?, group_based_projects=?, follows_instructions=?,
        leadership=?, focused, prioritize=?, communication_coworkers=?, communication_superiors=?,
        dependable=?, assignments_on_time=?, arrives_on_time=?, quality=? WHERE name=? AND week=? AND year=?;";

    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to parameters
        mysqli_stmt_bind_param($stmt, "diiiiiiiiiiiisii", $average, $initiative, 
            $gbProjects, $follows, $leadership, $focused, $prioritize, $workers,
            $superiors, $dependable, $punctualAss, $punctualTime, $quality, $name, $week, $year);
        //attempt to execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("refresh:0;employer.php");
        } else {
            echo "<h1>Something went wrong! Please retry.";
            header("refresh:5;employer.php");
        }
        mysqli_stmt_close($stmt);
    }
}

if ($_SESSION['title'] != 'employer') {
    die("Session expired!");
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

if (isset($_POST['submit'])) {                                                                       
                                                                            
    $workerName = $name;                                                                                                                     
                                                                            
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

    addEval($link, $_SESSION['token'], $workerName, $week, $year, $average, 
        $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize, 
        $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality);

    mysqli_close($link);
}
?>

