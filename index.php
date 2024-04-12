<?php
include(__DIR__ . '/session/session.php');
require_once __DIR__ . '/sql/users.php';
require_once __DIR__ . '/sql/token.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <H1>Welcome To Homepage</H1>
    <br>
    <h2>Debug User Info</h2>
    <ul>
        <li>Hi, <?php echo get_user_name($_SESSION["uuid"]); ?></li>
        <li>Your Email : <?php echo get_user_email($_SESSION["uuid"]); ?></li>
        <li>Your NIC : <?php echo get_user_nic($_SESSION["uuid"]); ?></li>
    </ul>
    <br>
    <h2>Debug Token Info</h2>
    <ul>
        <li>Your UUID : <?php echo $_SESSION["uuid"]; ?></li>
        <li>Your Token : <?php echo $_SESSION["token"]; ?></li>
        <li>Token Time Left : <?php echo get_session_time_left ($_SESSION["token"]); ?></li>
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>
