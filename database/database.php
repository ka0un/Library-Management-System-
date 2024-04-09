<?php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../database/dbsetup.php' ;

function getConnection()
{
    try{
        $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
    }catch (Exception $e){
        echo "Error: " . $e->getMessage();
    }


    if ($conn->connect_error) {
        echo "<h1>Database Connection Issue</h1><br>";
        echo "Please check if your database credentials in <b>config.php</b> are correct.<br>";
        die("Info: " . $conn->connect_error);
    }

    //this will setup the required tables if they arent initialized yet
    setup($conn);

    return $conn;
}
?>
