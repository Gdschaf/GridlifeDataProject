<?php
session_start();
require 'php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];

    $first_name = $mysqli->escape_string($_POST['firstname']);
    $last_name = $mysqli->escape_string($_POST['lastname']);
    $email = $mysqli->escape_string($_POST['email']);
    $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
    $hash = $mysqli->escape_string( md5( rand(0,1000) ) );

    if (empty($email) OR empty($first_name) OR empty($last_name) OR empty($mysqli->escape_string($_POST['password'])))
    {
        $_SESSION['message-type'] = "Error!";
        $_SESSION['message'] = "You're missing some fields to complete registration.";
        header("location: message.php");
    }

    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

    if ($result->num_rows > 0) {
        $_SESSION['message-type'] = "Error!";
        $_SESSION['message'] = "User with this email already exists!";
        header("location: message.php");
    }
    else {
        $sql = "INSERT INTO users (first_name, last_name, email, password, hash) "
                . "VALUES ('$first_name', '$last_name', '$email', '$password', '$hash')";

        if($mysqli->query($sql)) {
            
            $_SESSION['active'] = 0; // This user has not yet been verified
            $_SESSION['logged_in'] = true;
            $_SESSION['message'] = "Thanks for registering! Someone will have to verify your account before you can make edits to the database";

            $to = "gdschaf@radhangs.com";
            $subject = "Verification - New Account Created";
            $message_body = '
            '.$first_name.' '.$last_name.' ('.$email.') has created an account and requesting access.
            
            To grant this person access, please click the link below.
            
            http://radhangs.com/verify.php?email='.$email.'&hash='.$hash;

            mail($to, $subject, $message_body);

            $_SESSION['message-type'] = "Success!";
            header("location: message.php");
        }
        else {
            $_SESSION['message-type'] = "Error!";
            $_SESSION['message'] = "Registration failed!";
            header("location: message.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rad Hangs</title>
        <link rel="icon" href="img/RH Favicon_W-02.png">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/signup.css">
    </head>
    <body>
        <div class="grid-container">
            <header>
                <a href="/"><img class="header-logo" src="img/Header_Logo_2.png"></a>
            </header>
            <main>
                <div class="login">
			        <h1>Register</h1>
			        <form action="signup.php" method="post">
                        <label for="firstname"></label>
                        <input type="text" name="firstname" placeholder="First Name" id="firstname">
                        <input type="text" name="lastname" placeholder="Last Name" id="lastname">
				        <label for="email"></label>
				        <input type="email" name="email" placeholder="Email" id="email">
				        <label for="password"></label>
				        <input type="password" name="password" placeholder="Password" id="password">
				        <label for="confirm-password"></label>
				        <input type="password" name="confirm-password" placeholder="Confirm Password" id="confirm-password">
				        <input type="submit" value="Register">
			        </form>
		        </div>
                <div class="login-text">
                    Already have an account?&nbsp;<a class="login-link" href="login.php">Login!</a>
                </div>
            </main>
            <footer>
                FOOTER
            </footer>
            <img class="watermark" src="img/watermark_logo.png"/>
        </div>
    </body>
</html>