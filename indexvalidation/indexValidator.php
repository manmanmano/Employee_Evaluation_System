<?php                                                                           
if (isset($_POST['submit'])) {                                                  
                                                                                
    $title = $_POST['title'];                                                   
    if (!isset($title) || empty($title)) {                                      
        die("Radio button left blank!");                                        
    } else {                                                                    
        if ($title != "employee" && $title != "employer") {                     
            die("Corrupted data in radio input!");                              
        }                                                                       
    }                                                                           
                                                                                
    if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL) || empty($_POST['username'])) {
        die("Invalid email in input!");                                         
    }                                                                           
                                                                                
    if (strlen($_POST['password']) < 8 || empty($_POST['password'])) {          
        die("Invalid password in input. Too short!");                           
    }                                                                           
                                                                                
}                                                                               
?> 
