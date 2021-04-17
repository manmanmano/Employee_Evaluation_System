<?php

function addUser($link, $position, $name, $email, $hashedPassword, $employeeToken, $employerToken) {
    //insert a new user
    $query = "INSERT INTO users (title, name, email, password, token)
        VALUES (?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $query)) {
        //before binding check the position of the person
        if ($position == "employer") {
            //if employer than then the employee token
            mysqli_stmt_bind_param($stmt, "sssss", 
                $position, $name, $email, $hashedPassword, $employerToken);
        } else {
            //if not employer than employee
            mysqli_stmt_bind_param($stmt, "sssss", 
                $position, $name, $email, $hashedPassword, $employeeToken);
        } 
        //if execute is successful redirect to registrationSuccess
    }
}

?>
