<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../sql/users.php';
require_once __DIR__ . '/../auth/permission.php';

?>

<style>

    .container {
        position: relative;
        float: left;
        width: 250px;
        background-color: <?php echo PRIMARY_COLOR; ?>;
        overflow: auto;
        margin-top: 10px;
        height: 85%;
        border-radius: 20px;
        margin-right: 10px;
    }

    .tab {
        background-color: <?php echo SECONDARY_COLOR; ?>;
        color: <?php echo PRIMARY_COLOR; ?>;
        font-size: 20px;
        text-decoration: none;
        text-align: center;
        font-weight: bolder;
        height: 30px;
        margin: 10px;
        border-radius: 10px;
        font-family:Verdana, sans-serif;
    }

    .info {
        background-color: <?php echo TERTIARY_COLOR; ?>;
        color: <?php echo SECONDARY_COLOR; ?>;
        font-size: 18px;
        text-decoration: none;
        text-align: center;
        font-weight: bold;
        margin: 10px;
        border-radius: 10px;
        font-family:Verdana, sans-serif;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .tab:hover {
        color: #5e5e5e;
    }

    .welcome {
        font-weight: bolder;
        font-size: 30px;
    }

    .details {
        padding-top: 10px;
        font-weight: lighter;
        font-size: 15px;
    }

    a {
        text-decoration: none;
        color: <?php echo PRIMARY_COLOR; ?>;
    }

    a:visited {
        color: <?php echo PRIMARY_COLOR; ?>;
    }

    a:link {
        color: <?php echo PRIMARY_COLOR; ?>;
    }


</style>

<div class = "container">
<div class = "info">
    <div class = "welcome">
        Admin Panel
    </div>
    <div class = "details">
        user : <?php echo get_user_name($_SESSION['uuid']); ?>
    </div>
    <div class = "details">
        role : <?php echo get_role_name(get_role($_SESSION['uuid'])); ?>
    </div>
    <div class = "details">
        date : <?php echo date("Y/m/d"); ?>
    </div>
</div>

    <a href = "/../admin/index.php">
        <div class = "tab">
            Home
        </div>
    </a>

    <?php

    if (has_permission($_SESSION['uuid'], 'ADD_BOOK')) {
        echo '<a href = "/../admin/addbook.php">
        <div class = "tab">
            Add Book
        </div>
        </a>';
    }

    if (has_permission($_SESSION['uuid'], 'UPDATE_BOOK')) {
        echo '<a href = "/../admin/updatebook.php">
        <div class = "tab">
            Update Book
        </div>
        </a>';
    }

    if (has_permission($_SESSION['uuid'], 'CHECKOUT')) {
        echo '<a href = "/../admin/checkout.php">
        <div class = "tab">
            Checkout
        </div>
        </a>';
    }

    if (has_permission($_SESSION['uuid'], 'RETURN')) {
        echo '<a href = "/../admin/return.php">
        <div class = "tab">
            Return
        </div>
        </a>';
    }
    ?>

    <a href = "/../logout.php">
    <div class = "tab">
        Logout
    </div>
    </a>

</div>