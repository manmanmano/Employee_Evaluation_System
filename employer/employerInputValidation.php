<?php
//credentials for the session
require_once("../sessionstart.php");
//credentials for the database connection
include_once("../usersData/connect.db.php");

function createNames($token, $link) {
    include_once("../usersData/sanitizeInputVar");

    if (!$link) {
        die("Connection to DB failed: " . mysqli_connect_error());
    }

    $query = "SELECT name FROM users WHERE token='". $token . "' AND title='employee' ORDER BY name ASC;";
    $result = mysqli_query($link, $query);
    $names = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($names, $row['name']);
    }
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}
//this function sanitizes and validates all the radio buttons
function validateRadio($input) {
    //if the button is not set or is empty left blank
    if (!isset($input) || empty($input)) {                            
        die("Radio button left blank!");
    } else {                                                                    
        //if the button has a value less than 1 and greater than 5 than it is corrupted and exit
        if ($input < 1 && $input > 5) {                               
            die("Corrupted data in radio input!");                              
        }                                                                       
    } 
}
//evaluate the employee. the sum of the values of the radio button divided by the number of attributes
function evaluateEmployee($arr) {
    return array_sum($arr) / count($arr);
}
//this funciton adds an evaluation to MySQL database
//As parameters it takes all of the attributes, the name and the token of the employee/employer
//and the link of the database
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
//if the session title is not equal to employer then exit
if ($_SESSION['title'] != 'employer') {
    die("Session expired!");
}
//try to connect to the database
$link = mysqli_connect($server, $user, $password, $database);
if (!$link) die("Connection to DB failed: " . mysqli_connect_error());
//if submit is set
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
    //find the worker name. If the worker name is not in the array of names of employees then exit    
    $workerName = $_POST['worker_name'];                                            
    if (!empty($names) && !in_array($workerName, $names)) {                     
        die("Invalid worker name set!");                                        
    }                                                                           
    //assign a variable to each of the attributes                                                                            
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
    //this array contains all of the attributes
    $attrArr = [                                                                
        $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize,  
        $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality
    ];
    //every attribute is validated with the fundtion validateRadio
    foreach ($attrArr as $attr) {
        validateRadio($attr);
    }
    //using the funcion evaluateEmployee, we find the average and store it in a variable, round it to decimal
    $average = round(evaluateEmployee($attrArr), 1);                            
    //call the function to add a new evaluation to the database
    addEval($link, $_SESSION['token'], $workerName, $week, $year, $average, 
        $initiative, $gbProjects, $follows, $leadership, $focused, $prioritize, 
        $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality);
    //close the connection to the database
    mysqli_close($link);
}
?>
