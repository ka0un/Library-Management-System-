<?php
include(__DIR__ . '/../config.php');
$conn = new mysqli($host, $username, $password, $database, $port);
if(!$conn){
    die("Unable to connect database !");
}
?>