<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';

$conn = getConnection();

function add_announcement($title, $description, $end): void
{
    global $conn;

    $sql = "INSERT INTO announcement (title, description, start, end) VALUES (?, ?, now(), ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $end);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding announcement";
    }

    mysqli_stmt_close($stmt);

}

function update_announcement($id, $title, $description, $end): void
{
    global $conn;

    $sql = "UPDATE announcement SET title = ?, description = ?, end = ?, WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $end, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error updating announcement";
    }

    mysqli_stmt_close($stmt);
}

function delete_announcement($id): void
{
    global $conn;

    $sql = "DELETE FROM announcement WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error deleting announcement";
    }

    mysqli_stmt_close($stmt);
}

function get_array_of_announcement_ids(): array
{
    global $conn;

    $sql = "SELECT id FROM announcement";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $announcementids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($announcementids, $row['id']);
    }
    return $announcementids;
}

//getters

function get_announcement_title($id)
{
    global $conn;

    $sql = "SELECT title FROM announcement WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['title'];
    }
    return null;
}

function get_announcement_description($id)
{
    global $conn;

    $sql = "SELECT description FROM announcement WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['description'];
    }
    return null;
}

function get_announcement_start($id)
{
    global $conn;

    $sql = "SELECT start FROM announcement WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['start'];
    }
    return null;
}

function get_announcement_end($id)
{
    global $conn;

    $sql = "SELECT end FROM announcement WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['end'];
    }
    return null;
}

?>

