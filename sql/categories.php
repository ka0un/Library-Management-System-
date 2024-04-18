<?php
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';


$conn = getConnection();

function add_category($name): void
{
    global $conn;

    $sql = "INSERT INTO categories (name) VALUES (?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding category.";
    }

    mysqli_stmt_close($stmt);

}

function remove_category($categoryid): void
{
    global $conn;
    $sql = "DELETE FROM categories WHERE categoryid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $categoryid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing category.";
    }

    mysqli_stmt_close($stmt);
}

function update_category($categoryid, $name): void
{
    global $conn;

    $sql = "UPDATE categories SET name = ? WHERE categoryid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $categoryid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error updating category.";
    }

    mysqli_stmt_close($stmt);
}

function get_categroy_name($categoryid): string
{
    global $conn;
    $sql = "SELECT name FROM categories WHERE categoryid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $categoryid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['name'];
}

