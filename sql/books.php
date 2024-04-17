<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';


$conn = getConnection();


function add_book($bookid, $title, $author, $isbn, $reservations, $description, $categoryId): void
{
    global $conn;

    $sql = "INSERT INTO books (bookid, title, author, isbn, reservations, description, categoryid) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $bookid, $title, $author, $isbn, $reservations, $description, $categoryId);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding book.";
    }

    mysqli_stmt_close($stmt);
}

function remove_book($bookid): void
{
    global $conn;
    $sql = "DELETE FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing book.";
    }

    mysqli_stmt_close($stmt);
}

function update_book($bookid, $title, $author, $isbn, $reservations, $description, $categoryId): void
{
    global $conn;

    $sql = "UPDATE books SET title = ?, author = ?, isbn = ?, reservations = ?, description = ?, categoryid = ? WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssss", $title, $author, $isbn, $reservations, $description, $categoryId, $bookid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error updating book.";
    }

    mysqli_stmt_close($stmt);
}

function generate_bookID(): string
{
    global $conn;

    // Count the number of rows in the table
    $sql = "SELECT COUNT(*) FROM books";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $row_count = $row['COUNT(*)'];

    // Increment the row count to get the next UUID number
    $next_uuid_number = $row_count + 1;

    // Format the UUID with leading zeros
    //doc : https://www.php.net/manual/en/function.sprintf.php
    //guide : https://www.w3schools.com/php/func_string_sprintf.asp

    return 'B' . sprintf('%07d', $next_uuid_number);
}

function is_bookid_exists($bookid): bool
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $count = mysqli_fetch_row($result)[0];
    return $count > 0;
}

function get_amount_of_books(): int
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM books";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    return mysqli_fetch_assoc($result)['COUNT(*)'];
}

//setters

function set_book_reservations($bookid, $reservations): void
{
    global $conn;
    $sql = "UPDATE books SET reservations = ? WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $reservations, $bookid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error updating book reservations.";
    }

    mysqli_stmt_close($stmt);
}


// getters
function get_book_image($bookid){
    return get_default_book_image($bookid);
}

function get_default_book_image($bookid){
    if(USE_API_TO_DEFAULT_BOOK_COVER0){
        return "https://placehold.co/500x650/292929/D9D9D9/?text=".crop_text(get_book_title($bookid), 10);
    }else{
        return "/../images/cover.png";
    }

}

function get_book_title($bookid)
{
    global $conn;
    $sql = "SELECT title FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['title'];
    }
    return null;
}

function get_book_author($bookid)
{
    global $conn;
    $sql = "SELECT author FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['author'];
    }
    return null;
}

function get_book_isbn($bookid)
{
    global $conn;
    $sql = "SELECT isbn FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['isbn'];
    }
    return null;
}

function get_book_reservations($bookid)
{
    global $conn;
    $sql = "SELECT reservations FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['reservations'];
    }

    return null;
}

function get_book_description($bookid)
{
    global $conn;
    $sql = "SELECT description FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['description'];
    }
    return null;
}

function get_book_category_id($bookid)
{
    global $conn;
    $sql = "SELECT categoryid FROM books WHERE bookid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['categoryid'];
    }
    return null;
}


//private functions

function crop_text($input, $n) {
    if (strlen($input) > $n) {
        return substr($input, 0, $n) . '...';
    } else {
        return $input;
    }
}


