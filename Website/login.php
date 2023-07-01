<?php
session_start();
require 'php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //this is dumb, idk why it's not working...
    if (!isset($_POST['email']) OR empty($_POST['email']))
    {
        $_SESSION['message-type'] = "Error!";
        $_SESSION['message'] = "Email is empty. OMGWTFBBQ";
        header("location: message.php");
    }

    $email = $mysqli->escape_string($_POST['email']);

    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows == 0) {
        $_SESSION['message-type'] = "Error!";
        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: message.php");
    }
    else {
        $user = $result->fetch_assoc();

        if (password_verify($_POST['password'], $user['password'])) {
            //DO MORE STUFF HERE IN THE FUTURE, JUST MAKING SURE THIS WORKS ATM
            $_SESSION['message-type'] = "Success!";
            $_SESSION['message'] = "You have successfully logged in!";
            header("location: message.php");
        }
        else {
            $_SESSION['message-type'] = "Error!";
            $_SESSION['message'] = "You have entered the wrong password, try again!";
            header("location: message.php");
        }
    }
}
?>

<!-- Good video to reference for login system: https://www.youtube.com/watch?v=Pz5CbLqdGwM&t=509s -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rad Hangs</title>
        <link rel="icon" href="img/RH Favicon_W-02.png">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/form.css">
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <div class="grid-container">
            <header>
                <a href="/"><img class="header-logo" src="img/Header_Logo_2.png"></a>
            </header>
            <main>
                <div class="login">
			        <h1>Login</h1>
			        <form action="login.php" method="post">
				        <label for="email"></label>
				        <input type="email" name="email" placeholder="Email" id="email">
				        <label for="password"></label>
				        <input type="password" name="password" placeholder="Password" id="password">
                        <a type="forgot" href="#">Forgot Password?</a>
				        <input type="submit" value="Login">
			        </form>
		        </div>
                <div class="sign-up-text">
                    Don't have an account?&nbsp;<a class="sign-up-link" href="signup.php">Sign Up!</a>
                </div>
            </main>
            <footer>
                FOOTER
            </footer>
            <img class="watermark" src="img/watermark_logo.png"/>
        </div>
    </body>
</html>