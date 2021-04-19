<?php
require_once("../sessionstart.php");
include_once("../usersData/connect.db.php");

function createNames($token, $link) {
    include_once("../usersData/sanitizeInputVar");

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $query = "SELECT name FROM users WHERE token='". $token . "' AND title='employee';";
    $result = mysqli_query($link, $query);
    $names = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names, $row['name']);
    }
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

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

function addEval($link, $token, $name, $week, $year, $average, $initiative, $gbProjects, 
    $follows, $leadership, $focused, $prioritize, $workers, $superiors, $dependable, 
    $punctualAss, $punctualTime, $quality) {

    $query = "INSERT INTO token_" . $token . "
        (name, week, year, average, initiative, group_based_projects, follows_instructions,
        leadership, focused, prioritize, communication_coworkers, communication_superiors,
        dependable, assignments_on_time, arrives_on_time, quality)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $query)) {
        //bind variables to parameters
        mysqli_stmt_bind_param($stmt, "siidiiiiiiiiiiii", $name, $week, $year, 
            $average, $initiative, $gbProjects, $follows, $leadership, $focused, 
            $prioritize, $workers, $superiors, $dependable, $punctualAss,
            $punctualTime, $quality);
        //attempt to execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("refresh:0;employer.php");
        } else {
            echo "<h1>Something went wrong! Please retry.";
        }
        mysqli_stmt_close($stmt);
    }
}

if ($_SESSION['title'] != 'employer') {
    die("Incorrect credentials");
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

if (isset($_POST['submit'])) {

    if (!isset($_POST['date'])) {                                               
        die("No date set!");                                                    
    }
    $month = intval(date("m", strtotime($_POST['date'])));                      
    $day = intval(date("d", strtotime($_POST['date'])));                        
    $year = intval(date("Y", strtotime($_POST['date'])));                       
    $week = intval(date("W", strtotime($_POST['date'])));                       
    if (!checkdate($month, $day, $year)) {                                          
        die("Invalid date set!");                                               
    }                                                                           
                                                                            
    $workerName = $_POST['worker_name'];                                            
    if (!empty($names) && !in_array($workerName, $names)) {                     
        die("Invalid worker name set!");                                        
    }                                                                           
                                                                            
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
        $initiatve, $gbProjects, $follows, $leadership, $focused, $prioritize,  
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
