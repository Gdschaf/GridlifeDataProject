<?php
/* Database connection settings */
$host = 'localhost'; /* probably wanna make this localhost after putting it on the server 34.133.136.70*/
$user = 'root';
$pass = 'PczLgTfJfkhfq6';
$db = 'login';
$mysqli;
if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
    echo 'We don\'t have mysqli!!!';
} else {
    $mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
}