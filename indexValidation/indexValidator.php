<?php           
session_set_cookie_params(['path' => '~/juprus/icd0007_project/']);                                                                
session_start();                                                                           

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
    
$csvLine = explode(PHP_EOL, file_get_contents('../usersData/users.csv'));
foreach ($csvLine as $line) {
    $values = explode('; ', $line);
    if ($title == $values[0] && $username == $values[2] && $password == $values[3]) {
        $_SESSION['name'] = $values[1];
        $_SESSION['title'] = $values[0];
        $_SESSION['token'] = $values[4];
    } 
}

if (isset($_POST['submit']) && !isset($_SESSION['name'])) {
    echo "Incorrect credentials. Please try again!";
} else {
    if ($title == "employer") {
        header("refresh:5; ../employer/employer.php");
    } elseif ($title == "employee") {
        header("refresh:0; ../employee/employee.php");
    }# else {
     #   exit("Error!");
     #}
}

?> 
