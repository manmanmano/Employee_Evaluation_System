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

    addEval($link, $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize, 
        $workers, $superiors, $$dependable, $punctualAss, $punctualTime, $quality);

    header("refresh:0; url=employer.php");

    mysqli_close($link);
}
?>
