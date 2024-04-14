<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';

function add_record($copyid, $uuid, $start, $is_invalid): void
{
    global $conn;

    $sql = "INSERT INTO records (copyid, uuid, start, is_invalid) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $copyid, $uuid, $start, $is_invalid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding record.";
    }

    mysqli_stmt_close($stmt);
}

function remove_record($recordid): void
{
    invalidate_record($recordid);
}

function force_remove_record($recordid): void
{
    global $conn;
    $sql = "DELETE FROM records WHERE recordid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $recordid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing record.";
    }

    mysqli_stmt_close($stmt);
}

function get_latest_valid_recordID_of_copy($copyid): string
{
    global $conn;
    $sql = "SELECT recordid FROM records WHERE copyid = ? AND is_invalid = 0 ORDER BY start DESC LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['recordid'];
}

//getters

function get_record_copyid($recordid): string
{
    global $conn;
    $sql = "SELECT copyid FROM records WHERE recordid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $recordid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['copyid'];
}

function get_record_uuid($recordid): string
{
    global $conn;
    $sql = "SELECT uuid FROM records WHERE recordid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $recordid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['uuid'];
}

function get_record_start($recordid): string
{
    global $conn;
    $sql = "SELECT start FROM records WHERE recordid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $recordid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['start'];
}

function is_record_invalid($recordid): bool
{
    global $conn;
    $sql = "SELECT is_invalid FROM records WHERE recordid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $recordid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['is_invalid'];
}

function invalidate_record($recordid): void
{
    global $conn;
    $sql = "UPDATE records SET is_invalid = 1 WHERE recordid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $recordid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
