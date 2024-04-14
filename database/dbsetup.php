<?php

function setup($conn): void
{
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

    //label for sessions
    $sessions_table_create = "CREATE TABLE IF NOT EXISTS sessions (
        token VARCHAR(255) PRIMARY KEY,
        uuid VARCHAR(255),
        start TIMESTAMP                           
    );";

    $books_table_create = "CREATE TABLE IF NOT EXISTS books (
        bookid VARCHAR(255) PRIMARY KEY,
        title VARCHAR(255),
        author VARCHAR(255),
        isbn VARCHAR(255),
        reservations INT,
        description TEXT,
        categoryid VARCHAR(255),
        FOREIGN KEY (categoryid) REFERENCES categories(categoryid)
                            
    );";

    $copies_table_create = "CREATE TABLE IF NOT EXISTS copies (
        copyid VARCHAR(255) PRIMARY KEY,
        bookid VARCHAR(255),
        status VARCHAR(255),
        pr BOOLEAN,
        pcondition VARCHAR(255),
        FOREIGN KEY (bookid) REFERENCES books(bookid)
    );";

    $category_table_create = "CREATE TABLE IF NOT EXISTS categories (
        categoryid VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255)
    );";

    $records_table_create = "CREATE TABLE IF NOT EXISTS records (
        recordid VARCHAR(255) PRIMARY KEY,
        copyid VARCHAR(255),
        uuid VARCHAR(255),
        start TIMESTAMP,
        is_invalid BOOLEAN,
        FOREIGN KEY (copyid) REFERENCES copies(copyid),
        FOREIGN KEY (uuid) REFERENCES users(uuid)
    );";

    //if table not exists create table
    if (!($conn->query($users_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    if (!($conn->query($sessions_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    //books part

    if (!($conn->query($category_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }


    if (!($conn->query($books_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    if (!($conn->query($copies_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }


    if (!($conn->query($records_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }


}

?>