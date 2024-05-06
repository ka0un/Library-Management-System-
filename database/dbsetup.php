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
        categoryid INT,
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
        categoryid INT PRIMARY KEY AUTO_INCREMENT,
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

    $ratings_table_create = "CREATE TABLE IF NOT EXISTS ratings (
        rating_id INT AUTO_INCREMENT PRIMARY KEY,
        book_id VARCHAR(255),
        user_id VARCHAR(255),
        rating INT,
        FOREIGN KEY (book_id) REFERENCES books(bookid),
        FOREIGN KEY (user_id) REFERENCES users(uuid)
    );";

    $transactions_table_create = "CREATE TABLE IF NOT EXISTS transactions (
        transaction_id INT AUTO_INCREMENT PRIMARY KEY,
        book_id VARCHAR(255),
        user_id VARCHAR(255),
        type ENUM('checkout', 'return'),
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (book_id) REFERENCES books(bookid),
        FOREIGN KEY (user_id) REFERENCES users(uuid)
    );";


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

    if (!($conn->query($ratings_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }

    if (!($conn->query($transactions_table_create) === TRUE)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }


}

