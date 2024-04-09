<?php

function setup($conn) {
    require_once __DIR__ . '/../config.php';
    require_once __DIR__ . '/../database/database.php' ;


    // Corrected the CREATE TABLE query
    $users_table_create = "CREATE TABLE IF NOT EXISTS users (
        uuid VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        nic VARCHAR(255),
        password VARCHAR(255)
    );";

    //if table not exists create table
    if (!($conn->query($users_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }


}

?>