<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';

if (!has_permission($_SESSION['uuid'], 'CHECKOUT')) {
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
        flex-direction: row;
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

    .part{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-top: 10px;
        margin-left: 5px;
        margin-right: 5px;
        margin-bottom: 10px;
        border-radius: 10px;
        height: 95%;
        width: 30%;
        font-family:Verdana, sans-serif;
        font-weight: bold;
        font-size: 14px;

    }

    .input{
        background-color: <?php echo PRIMARY_COLOR; ?>;
        color: <?php echo SECONDARY_COLOR; ?>;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
        border-radius: 10px;
        height: 50%;
        font-family:Verdana, sans-serif;
        font-weight: bold;
        font-size: 14px;
    }

    .output {
        background-color: <?php echo SECONDARY_COLOR; ?>;
        color: <?php echo PRIMARY_COLOR; ?>;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px;
        border-radius: 10px;
        height: 100%;
        font-family: Verdana, sans-serif;
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
    <div class="part">
        <div class="input">

            <h1>Enter User ID</h1>
            <form action="" method="post">
                <input type="text" name="userid" id="userid" required autocapitalize="characters" >
                <br><br>
                <input type="submit" value="Submit">
            </form>


        </div>
        <div class="output">

        </div>
    </div>
    <div class="part">
        <div class="input">

            <h1>Enter Copy ID</h1>
            <form action="" method="post">
                <input type="text" name="copyid" id="copyid" required autocapitalize="characters" >
                <br><br>
                <input type="submit" value="Submit">
            </form>


        </div>
        <div class="output">

        </div>
    </div>
    <div class="part">
        <div class="output">

        </div>
    </div>
</div>