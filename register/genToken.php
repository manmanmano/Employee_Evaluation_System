<?php
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $tokenString = '';
    for ($i = 0; $i < $length; $i++) {
        $tokenString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $tokenString;
    }
?>
