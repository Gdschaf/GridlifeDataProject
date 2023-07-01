<?php
session_start();
require 'db.php';

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']); 
    $hash = $mysqli->escape_string($_GET['hash']); 
    
    // Select user with matching email and hash, who's accounts haven't been verified'
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    { 
        $_SESSION['message-type'] = "Error!";
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";

        header("location: message.php");
    }
    else {
        $_SESSION['message-type'] = "Success!";
        $_SESSION['message'] = 'The account for '.$email.' has successfully been verified!';
        
        // Set the user status to active (active = 1)
        $mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;
        
        header("location: message.php");
    }
}
else {
    $_SESSION['message-type'] = "Error!";
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    header("location: message.php");
}    
?>