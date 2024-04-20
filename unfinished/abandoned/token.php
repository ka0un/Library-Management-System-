<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';
$conn = getConnection();
function generate_token($uuid): string
{
    global $conn;
    $token = bin2hex(random_bytes(32));
    $sql = "INSERT INTO sessions (token, uuid, start) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $uuid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $token;
}

function validate_token($uuid, $token): bool
{
    global $conn;
    $sql = "SELECT * FROM sessions WHERE token = ? AND uuid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);


    invalidate_all_other_outdated_tokens($uuid);


    if (mysqli_num_rows($result) > 0){
        if (check_if_token_outdated($uuid, $token, SESSION_LIFETIME_SECONDS)){
            delete_token($uuid, $token);
            session_destroy();
            return false;
        }
        return true;
    }
    return false;
}

function invalidate_all_other_outdated_tokens_of_everyone(): void
{
    global $conn;
    $sql = "SELECT uuid FROM sessions";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        invalidate_all_other_outdated_tokens($row['uuid']);
    }
}

function invalidate_all_other_outdated_tokens($uuid): void
{
    global $conn;
    $sql = "SELECT token FROM sessions WHERE uuid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        if (check_if_token_outdated($uuid, $row['token'], SESSION_LIFETIME_SECONDS)){
            delete_token($uuid, $row['token']);
        }
    }
}

function delete_token($uuid, $token): void
{
    global $conn;
    $sql = "DELETE FROM sessions WHERE token = ? AND uuid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $uuid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function delete_all_tokens($uuid): void
{
    global $conn;
    $sql = "DELETE FROM sessions WHERE uuid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function check_if_token_outdated($uuid, $token, $lifeInSeconds): bool
{
    global $conn;
    $sql = "SELECT start FROM sessions WHERE token = ? AND uuid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $token, $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        $tokenTimestamp = strtotime($row['start']);
        $currentTimestamp = time();
        return ($currentTimestamp - $tokenTimestamp) > $lifeInSeconds;
    } else {
        return true;
    }
}

function get_session_time_left($token): int
{
    global $conn;
    $sql = "SELECT start FROM sessions WHERE token = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        $tokenTimestamp = strtotime($row['start']);
        $currentTimestamp = time();
        return SESSION_LIFETIME_SECONDS - ($currentTimestamp - $tokenTimestamp);
    } else {
        return 0;
    }
}