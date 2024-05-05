<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';


$conn = getConnection();

function add_ticket($uuid): void
{
    global $conn;

    $sql="INSERT INTO ticket(uuid) value(?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding ticket.";
    }

    mysqli_stmt_close($stmt);
}

function remove_ticket($ticket_id): void
{
    global $conn;

    $sql="DELETE FROM ticket WHERE ticket_id = ?";

    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$ticket_id);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) == 0){
        echo "Error remove ticket. ";
    }

    mysqli_stmt_close($stmt);
}

/*function get_ticket_uuid($ticket_id)
{
    global $conn;

    $sql="SELECT uuid FROM ticket WHERE ticket_id = ?";

    $stmt=mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,"s",$uuid);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) == 0){
        echo "Error get ticket. ";
    }
    return null;

    mysqli_stmt_close($stmt);
}*/

function is_user_has_ticket($uuid): bool
{
    global $conn;

    $sql = "SELECT COUNT(*) FROM ticket WHERE uuid=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $count > 0;
}


function get_array_of_ticketids(): array
{
    global $conn;

    $sql = "SELECT content FROM messages";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $content = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $content[] = $row['content'];
    }
    return $content;

}

function get_ticketid_of_user($uuid)
{
    global $conn;
    $sql = "SELECT ticket_id FROM ticket where uuid = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return mysqli_fetch_assoc($result)['ticket_id'];

}

?>