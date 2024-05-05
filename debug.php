<?php
include(__DIR__ . '/auth/session.php');
require_once __DIR__ . '/sql/users.php';
require_once __DIR__ . '/auth/permission.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug</title>
</head>
<body>
<H1>Debug Panel</H1>
<br>
<h2>Debug User Info</h2>
<ul>
    <li><img alt="Profile-Picture" width="128" src=<?php echo get_user_profile_picture_url($_SESSION["uuid"], 256); ?> ></li>
    <li>Hi, <?php echo get_user_name($_SESSION["uuid"]); ?></li>
    <li>Your Email : <?php echo get_user_email($_SESSION["uuid"]); ?></li>
    <li>Your NIC : <?php echo get_user_nic($_SESSION["uuid"]); ?></li>
</ul>
<br>
<h2>Debug Permission Info</h2>
<ul>
    <li>Role : <?php echo get_role_name(get_role($_SESSION["uuid"])); ?></li>
    <li>Role ID : <?php echo get_role($_SESSION["uuid"]); ?></li>
    <li>Has Admin Permission : <?php if (has_permission($_SESSION["uuid"], "VIEW_ADMIN_DASHBOARD")) echo "true"; else echo "false" ?></li>
    <li>Has Every Permission : <?php if (has_permission($_SESSION["uuid"], "RADMOM")) echo "true"; else echo "false" ?></li>
</ul>
<br>
<a href="index.php">Back to home1</a>
</body>
</html>