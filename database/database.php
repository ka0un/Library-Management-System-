<?php
include(__DIR__ . '/../config.php');
$conn = new mysqli($host, $username, $password, $database, $port);
if(!$conn){

    include(__DIR__ . '/../database/dbsetup.php');
    setup();
    
}
?>
