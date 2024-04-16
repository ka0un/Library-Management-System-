<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';

$conn = getConnection();

function add_reservation($bookid, $uuid): void
{
    global $conn;

    $sql = "INSERT INTO reservations (bookid, uuid, start, valid) VALUES (?, ?, now(), 1)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $bookid, $uuid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding reservation.";
    }

    mysqli_stmt_close($stmt);

}

function remove_reservation($reservationid): void
{
    invalidate_reservation($reservationid);
}

function force_remove_reservation($reservationid): void
{
    global $conn;
    $sql = "DELETE FROM reservations WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reservationid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing reservation.";
    }

    mysqli_stmt_close($stmt);
}

function get_amount_of_reservations_of_book($bookid): int
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM reservations WHERE bookid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'];
}

function get_amount_of_reservations_of_user($uuid): int
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM reservations WHERE uuid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'];
}

function get_reservation_ids_of_user($uuid): array
{
    global $conn;
    $sql = "SELECT id FROM reservations WHERE uuid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $reservationids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($reservationids, $row['id']);
    }
    return $reservationids;
}

function get_reservation_ids_of_book($bookid): array
{
    global $conn;
    $sql = "SELECT id FROM reservations WHERE bookid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $reservationids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($reservationids, $row['id']);
    }
    return $reservationids;
}

function is_user_reserved_book($uuid, $bookid): bool
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM reservations WHERE uuid = ? AND bookid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $uuid, $bookid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'] > 0;
}


//getters and setters

function invalidate_reservation($reservationid): void
{
    global $conn;
    $sql = "UPDATE reservations SET valid = 0 WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reservationid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error invalidating reservation.";
    }

    mysqli_stmt_close($stmt);
}

function get_reservation_id($bookid, $userid): int
{
    global $conn;
    $sql = "SELECT id FROM reservations WHERE bookid = ? AND uuid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $bookid, $userid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}

function get_reservation_start($reservationid): string
{
    global $conn;
    $sql = "SELECT start FROM reservations WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reservationid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['start'];
}

function get_reservation_valid($reservationid): bool
{
    global $conn;
    $sql = "SELECT valid FROM reservations WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reservationid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['valid'];
}

function get_reservation_uuid($reservationid): string
{
    global $conn;
    $sql = "SELECT uuid FROM reservations WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reservationid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['uuid'];
}

function get_reservation_book_id($reservationid): string
{
    global $conn;
    $sql = "SELECT bookid FROM reservations WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $reservationid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['bookid'];
}


