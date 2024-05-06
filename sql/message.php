<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';

$conn = getConnection();

function add_messages($ticket_id,$sender_uuid,$content): void
{
    global $conn;

    $sql = "INSERT INTO messages (ticket_id,sender_uuid,content,time) VALUES (?, ?, ?, now())";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $ticket_id,$sender_uuid,$content);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding message.";
    }

    mysqli_stmt_close($stmt);
}

function delete_messages($msg_id): void
{
    global $conn;

    $sql = "DELETE FROM messages WHERE msg_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $msg_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding message.";
    }

    mysqli_stmt_close($stmt);
}

function get_message_ticket_id($msg_id)
{
    global $conn;
    $sql = "SELECT ticket_id FROM messages WHERE msg_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $msg_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['ticket_id'];
    }
    return null;
}

function get_message_user_id($msg_id)
{
    global $conn;
    $sql = "SELECT sender_uuid FROM messages WHERE msg_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $msg_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['sender_uuid'];
    }
    return null;
}

/*function get_ticket_staff($msg_id): string
{
    global $conn;
    $sql = "SELECT content FROM messages WHERE msg_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $msg_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['content'];
    }
    return null;
}*/

function get_message_content($msg_id): string
{
    global $conn;
    $sql = "SELECT content FROM messages WHERE msg_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $msg_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['content'];
    }
    return null;
}

function get_array_of_msgids($ticket_id): array
{
    global $conn;
    $sql = "SELECT msg_id FROM messages where ticket_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $msgids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $msgids[] = $row['msg_id'];
    }

    return $msgids;
}

function update_responses_column($ticket_id) 
{
    global $conn;
    $sql="UPDATE ticket_table SET responses = CASE WHEN (SELECT COUNT(DISTINCT uuid) FROM ticket_table WHERE ticket_id = ?) > 2 THEN 1 ELSE 0 END WHERE ticket_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $ticket_id, $ticket_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


?>