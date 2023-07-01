<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rad Hangs</title>
        <link rel="icon" href="img/RH Favicon_W-02.png">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/message.css">
    </head>
    <body>
        <div class="grid-container">
            <header>
                <a href="/"><img class="header-logo" src="img/Header_Logo_2.png"></a>
            </header>
            <main>
                <h1>
                    <?php
                    if (isset($_SESSION['message-type']) AND !empty($_SESSION['message-type'])):
                        echo $_SESSION['message-type'];
                    else:
                        echo "Unknown";
                    endif;
                    ?>
                </h1>
                <p>
                <?php
                if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
                    echo $_SESSION['message'];
                else:
                    header("location: login.php");
                endif;
                ?>
                </p>
            </main>
            <footer>
                FOOTER
            </footer>
            <img class="watermark" src="img/watermark_logo.png"/>
        </div>
    </body>
</html>