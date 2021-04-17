<?php

function addUser($link, $position, $name, $email, $hashedPassword, $employeeToken, $employerToken) {
    //insert a new user
    $query = "INSERT INTO users (title, name, email, password, token)
        VALUES (?, ?, ?, ?, ?)";
}

?>
