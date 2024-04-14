<?php
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';


$conn = getConnection();

function add_copy($copyid, $bookid, $status, $pr, $pcondition): void
{
    global $conn;

    $sql = "INSERT INTO copies (copyid, bookid, status, pr, pcondition) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $copyid, $bookid, $status, $pr, $pcondition);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding copy.";
    }

    mysqli_stmt_close($stmt);
}

function remove_copy($copyid): void
{
    global $conn;
    $sql = "DELETE FROM copies WHERE copyid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing copy.";
    }

    mysqli_stmt_close($stmt);
}

function update_copy($copyid, $bookid, $status, $pr, $pcondition): void
{
    global $conn;

    $sql = "UPDATE copies SET bookid = ?, status = ?, pr = ?, pcondition = ? WHERE copyid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $bookid, $status, $pr, $pcondition, $copyid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error updating copy.";
    }

    mysqli_stmt_close($stmt);
}

function generate_copyID(): string
{
    global $conn;

    // Count the number of rows in the table
    $sql = "SELECT COUNT(*) FROM copies";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $row_count = $row['COUNT(*)'];

    // Increment the row count to get the next UUID number
    $next_uuid_number = $row_count + 1;

    // Format the UUID with leading zeros
    //doc : https://www.php.net/manual/en/function.sprintf.php
    //guide : https://www.w3schools.com/php/func_string_sprintf.asp

    return 'C' . sprintf('%07d', $next_uuid_number);
}

//getters
function get_copy_bookid($copyid): string
{
    global $conn;
    $sql = "SELECT bookid FROM copies WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['bookid'];
}

function get_copy_status($copyid): string
{
    global $conn;
    $sql = "SELECT status FROM copies WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['status'];
}

function is_copy_pr($copyid): bool
{
    global $conn;
    $sql = "SELECT pr FROM copies WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['pr'];
}

function get_copy_pcondition($copyid): string
{
    global $conn;
    $sql = "SELECT pcondition FROM copies WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['pcondition'];
}

function get_amount_of_copies($bookid): int
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM copies WHERE bookid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'];
}


//continue with setters

function set_copy_bookid($copyid, $bookid): void
{
    global $conn;
    $sql = "UPDATE copies SET bookid = ? WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $bookid, $copyid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function set_copy_status($copyid, $status): void
{
    global $conn;
    $sql = "UPDATE copies SET status = ? WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $status, $copyid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function set_copy_pr($copyid, $pr): void
{
    global $conn;
    $sql = "UPDATE copies SET pr = ? WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $pr, $copyid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function set_copy_pcondition($copyid, $pcondition): void
{
    global $conn;
    $sql = "UPDATE copies SET pcondition = ? WHERE copyid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $pcondition, $copyid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


