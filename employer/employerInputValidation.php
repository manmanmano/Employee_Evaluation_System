<?php
function createNames() {
    $names = ['John Smith', 'Mary Jane', 'James Doe'];
    for ($i = 0; $i < sizeof($names); $i++) {
        printf("<option value ='%s'>%s</option>", $names[$i], $names[$i]);
    }
}

function evaluateEmployee($arr) {
    return array_sum($arr) / count($arr);
}

if (isset($_POST['submit'])) {                                                  
    $date = intval(date("W", strtotime($_POST['date'])));                                                                            
    $names = $_POST['worker_name'];
    echo $names;                                             
    if (isset($names) && ($names != 'James Doe' || $names != 'Mary Jane' || $names != 'John Smith')) {
        die("Invalid worker name set!");                                        
    }  

    $initiative = $_POST['initiative'];                                         
    if (!isset($initiative) || empty($initiative)) {                            
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($initiative != 1 && $initiative != 5) {                             
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $gbProjects = $_POST['group_based_projects'];                               
    if (!isset($gbProjects) || empty($gbProjects)) {                            
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($gbProjects != 1 && $gbProjects != 5) {                             
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $follows = $_POST['follows_instructions'];                                  
    if (!isset($follows) || empty($follows)) {                                  
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($follows != 1 && $follows != 5) {                                   
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $leadership = $_POST['leadership'];                                         
    if (!isset($leadership) || empty($leadership)) {                            
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($leadership != 1 && $leadership != 5) {                             
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $focused = $_POST['focused'];                                               
    if (!isset($focused) || empty($focused)) {                                  
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($focused != 1 && $focused != 5) {                                   
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $prioritize = $_POST['prioritize'];                                         
    if (!isset($prioritize) || empty($prioritize)) {                            
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($prioritize != 1 && $prioritize != 5) {                             
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $workers = $_POST['communication_coworkers'];                               
    if (!isset($workers) || empty($workers)) {                                  
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($workers != 1 && $workers != 5) {                                   
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $superiors = $_POST['communication_superiors'];                             
    if (!isset($superiors) || empty($superiors)) {                              
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($superiors != 1 && $superiors != 5) {                               
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    $dependable = $_POST['dependable'];                                         
    if (!isset($dependable) || empty($dependable)) {                            
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($dependable != 1 && $dependable != 5) {                             
            die("Corrupted data in radio input!");                              
        }                                                                       
    }

     $punctualAss = $_POST['assignments_on_time'];
    if (!isset($punctualAss) || empty($punctualAss)) {
        die("Radio button left blank!");
    } else {
        if ($punctualAss != 1 && $punctualAss != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $punctualTime = $_POST['arrives_on_time'];
    if (!isset($punctualTime) || empty($punctualTime)) {
        die("Radio button left blank!");
    } else {
        if ($punctualTime != 1 && $punctualTime != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $quality = $_POST['quality'];
    if (!isset($quality) || empty($quality)) {
        die("Radio button left blank!");
    } else {
        if ($quality != 1 && $quality != 5) {
            die("Corrupted data in radio input!");
        }
    }

    $attrArr = [
        $initiatve, $gbProjects, $follows, $leadership, $focused, $prioritize,
        $workers, $superiors, $dependable, $punctualAss, $punctualTime, $quality 
    ];

    $average = evaluateEmployee($attrArr);

    $data = $names . chr(44) . $date . chr(44) . $average . PHP_EOL;

    file_put_contents('newEval.csv', $data, FILE_APPEND);

}
?>
