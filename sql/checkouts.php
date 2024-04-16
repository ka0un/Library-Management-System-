<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';

$conn = getConnection();

function add_checkout($copyid, $uuid): void
{
    global $conn;

    $sql = "INSERT INTO checkouts (copyid, uuid, start, valid) VALUES (?, ?, now(), 1)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $copyid, $uuid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding checkout.";
    }

    mysqli_stmt_close($stmt);

}

function remove_checkout($checkoutid): void
{
    invalidate_checkout($checkoutid);
}

function force_remove_checkout($checkoutid): void
{
    global $conn;
    $sql = "DELETE FROM checkouts WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkoutid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing checkout.";
    }

    mysqli_stmt_close($stmt);
}

function get_amount_of_checkouts_of_user($uuid): int
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM checkouts WHERE uuid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'];
}


function get_checkoutid_of_active_checkout($uuid, $copyid): string
{
    global $conn;
    $sql = "SELECT id FROM checkouts WHERE uuid = ? AND copyid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $uuid, $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}

function get_checkoutids_of_user($uuid): array
{
    global $conn;
    $sql = "SELECT id FROM checkouts WHERE uuid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $checkoutids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($checkoutids, $row['id']);
    }
    return $checkoutids;
}

function is_copy_alredy_checked_out($copyid): bool
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM checkouts WHERE copyid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'] > 0;
}

function invalidate_checkout($checkoutid): void
{
    global $conn;
    $sql = "UPDATE checkouts SET valid = 0 WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkoutid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error invalidating checkout.";
    }

    mysqli_stmt_close($stmt);
}

function is_user_checked_out_copy($uuid, $copyid): bool
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM checkouts WHERE uuid = ? AND copyid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $uuid, $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['COUNT(*)'] > 0;
}

function get_checkout_id($uuid, $copyid): string
{
    global $conn;
    $sql = "SELECT id FROM checkouts WHERE uuid = ? AND copyid = ? AND valid = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $uuid, $copyid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}


// getters
function get_checkout_copyid($checkoutid): string
{
    global $conn;
    $sql = "SELECT copyid FROM checkouts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkoutid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['copyid'];
}

function get_checkout_uuid($checkoutid): string
{
    global $conn;
    $sql = "SELECT uuid FROM checkouts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkoutid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['uuid'];
}

function get_checkout_start($checkoutid): string
{
    global $conn;
    $sql = "SELECT start FROM checkouts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkoutid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['start'];
}

function get_checkout_valid($checkoutid): bool
{
    global $conn;
    $sql = "SELECT valid FROM checkouts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $checkoutid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['valid'];
}

