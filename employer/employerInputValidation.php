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
    mysqli_close($link);
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

if ($_SESSION['title'] != 'employer') {
    die("Incorrect credentials");
}

$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());

if (!isset($_POST['date'])) {                                               
    die("No date set!");                                                    
}
$month = intval(date("m", strtotime($_POST['date'])));                      
$day = intval(date("d", strtotime($_POST['date'])));                        
$year = intval(date("y", strtotime($_POST['date'])));                       
$week = intval(date("W", strtotime($_POST['date'])));                       
if (!checkdate($month, $day, $year)) {                                          
    die("Invalid date set!");                                               
}                                                                           
                                                                            
$workerName = $_POST['worker_name'];                                            
if (!empty($names) && !in_array($workerName, $names)) {                     
    die("Invalid worker name set!");                                        
}                                                                           
                                                                            
$initiative = $_POST['initiative'];                                         
validateRadio($initiative);

$gbProjects = $_POST['group_based_projects'];                               
validateRadio($gbProjects);
                                                                                
$follows = $_POST['follows_instructions'];                                  
validateRadio($follows);

$leadership = $_POST['leadership'];                                         
validateRadio($leadership);                                                                            

$focused = $_POST['focused'];                                               
validateRadio($focused);                                                                            

$prioritize = $_POST['prioritize'];                                         
validateRadio($prioritize);                                                                            

$workers = $_POST['communication_coworkers'];                               
validateRadio($workers);                                                                            

$superiors = $_POST['communication_superiors'];                             
validateRadio($superiors);

$dependable = $_POST['dependable'];                                         
validateRadio($dependable);                                                                            

$punctualAss = $_POST['assignments_on_time'];                              
validateRadio($punctualAss);                                                                            

$punctualTime = $_POST['arrives_on_time'];                                  
validateRadio($punctualTime);                                                                            

$quality = $_POST['quality'];                                               
validateRadio($quality);

$attrArr = [                                                                
    $initiatve, $gbProjects, $follows, $leadership, $focused, $prioritize,  
    $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality
];

$average = round(evaluateEmployee($attrArr), 1);                            



header("refresh:0; url=employer.php");

?>
