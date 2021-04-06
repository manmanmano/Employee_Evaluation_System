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
                                                                                
    $username = $_POST['email'];
    if (!filter_var($username, FILTER_VALIDATE_EMAIL) || empty($username)) {
        die("Invalid email in input!");                                         
    }                                                                           
    
    $password = $_POST['password'];    
    if (strlen($password) < 8 || empty($password)) {          
        die("Invalid password in input!");                           
    }                                                                           

    if ($title == "employer") {
        header("refresh=0; url=../employer/employer.php");
    } else {
        header("refresh=0; url=../employee/employee.php");
    }
                                                                                
}                                                                               
?> 
