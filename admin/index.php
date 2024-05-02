<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';

if (!has_permission($_SESSION['uuid'], 'VIEW_ADMIN_DASHBOARD')) {
    header("Location: /index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style/book.php">

</head>


<style>
    .panel{
        background-color: <?php echo TERTIARY_COLOR; ?>;
        color: <?php echo PRIMARY_COLOR; ?>;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        margin-left: 10px;
        border-radius: 10px;
        height: 85%;
        font-family:Verdana, sans-serif;
        font-weight: bold;
        font-size: 14px;
    }
</style>

<body bgcolor="<?php echo SECONDARY_COLOR;?>">
<?php

generate_header(array());

?>

<?php
include( __DIR__ . '/../components/sidebar.php');
?>

<div class="panel">
    <p>Welcome to the admin panel. Here you can manage the library system.</p>
</div>


