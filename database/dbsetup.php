<?php

function setup() {
    include(__DIR__ . '/../config.php');

    // Connect without selecting a database
    $conn = new mysqli($host, $username, $password, "", $port);
    if ($conn->connect_error) {
        echo "<h1>Database Connection Issue</h1><br>";
        echo "Please check if your database credentials in <b>config.php</b> are correct.<br>";
        die("Info: " . $conn->connect_error);
    }

    // Check if the database exists, create if not
    if (!$conn->select_db($database)) {
        $createDbQuery = "CREATE DATABASE IF NOT EXISTS $database";
        if ($conn->query($createDbQuery) === TRUE) {
            echo "Database created successfully or already exists.<br>";
            $conn->select_db($database);
        } else {
            echo "Error creating database: " . $conn->error;
            return;
        }
    }

    // Corrected the CREATE TABLE query
    $users_table_create = "CREATE TABLE IF NOT EXISTS users (
        uuid VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        nic VARCHAR(255),
        password VARCHAR(255),
        CONSTRAINT uuid_format CHECK (uuid LIKE 'U0000000%')
    );";

    // Execute the query
    if ($conn->query($users_table_create) === TRUE) {
        echo "Table 'users' created successfully or already exists.<br>";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
}

?>