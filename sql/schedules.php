<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';


$conn = getConnection();

function set_schedule_time($id) : void
{
    global $conn;

    $sql = "UPDATE schedules SET time = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    $time = time();
    mysqli_stmt_bind_param($stmt, "ss", $time, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error setting schedule time.";
    }

    mysqli_stmt_close($stmt);
}

function get_schedule_time($id) : int
{
    global $conn;

    $sql = "SELECT time FROM schedules WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $row['time'];
}

function check_if_id_exists($id) : bool
{
    global $conn;

    $sql = "SELECT COUNT(*) FROM schedules WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $count = mysqli_fetch_row($result)[0];
    return $count > 0;
}

function create_schedule($id) : void
{
    global $conn;

    $sql = "INSERT INTO schedules (id, time) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    $time = time();
    mysqli_stmt_bind_param($stmt, "ss", $id, $time);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
}

