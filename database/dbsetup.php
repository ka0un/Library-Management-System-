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

    $reservations_table_create = "CREATE TABLE IF NOT EXISTS reservations (
        id INT PRIMARY KEY AUTO_INCREMENT,
        uuid VARCHAR(255),
        bookid VARCHAR(255),
        start TIMESTAMP,
        valid BOOLEAN,
        FOREIGN KEY (uuid) REFERENCES users(uuid),
        FOREIGN KEY (bookid) REFERENCES books(bookid)
    );";

    $checkouts_table_create = "CREATE TABLE IF NOT EXISTS checkouts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        uuid VARCHAR(255),
        copyid VARCHAR(255),
        start TIMESTAMP,
        valid BOOLEAN,
        FOREIGN KEY (uuid) REFERENCES users(uuid),
        FOREIGN KEY (copyid) REFERENCES copies(copyid)
    );";

    $schedules_table_create = "CREATE TABLE IF NOT EXISTS schedules (
        id VARCHAR(255) PRIMARY KEY,
        time TIMESTAMP
    );";

    $Books_report_table_create = "CREATE TABLE IF NOT EXISTS books_report (
        copyid VARCHAR(50) PRIMARY KEY,
        action VARCHAR(50),
        uuid VARCHAR(50),
        date DATE,
        time TIME
        );";

    $filtered_temporary_report_table_create = "CREATE TABLE IF NOT EXISTS tempory_books_report (
        copyid VARCHAR(50) PRIMARY KEY,
        action VARCHAR(50),
        uuid VARCHAR(50),
        date DATE,
        time TIME
        );";
    $user_Actions_table_create = "CREATE TABLE IF NOT EXISTS user_access_system(
        uuid VARCHAR(50),
        access VARCHAR(50),
        date DATE,
        time TIME
)";
    $staff_actions_table_create ="CREATE TABLE IF NOT EXISTS staff_action_system(
        uuid VARCHAR(50),
        action VARCHAR(50),
        copyid varchar(50),
        date DATE,
        time TIME
)";
    $past_users_table_create ="CREATE TABLE IF NOT EXISTS past_users(
        nic varchar(50),
        name varchar(50),
        email varchar(50),
        banned_date date,
        admin_id varchar(50),
        
)";


    //if table not exists create table
    if (!($conn->query($users_table_create) === TRUE)) {
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

    if (!($conn->query($reservations_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    if (!($conn->query($checkouts_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    if (!($conn->query($schedules_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

  //report part
     if (!($conn->query($Books_report_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

     if (!($conn->query($filtered_temporary_report_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

     if (!($conn->query($user_Actions_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

     if (!($conn->query($staff_actions_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

     if (!($conn->query($past_users_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

}

