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
       /* display: flex;
        flex-direction: column;*/
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        margin-left: 10px;
        border-radius: 10px;
        height: 85%;
        font-family:Verdana, sans-serif;
        font-weight: bold;
        /*font-size: 14px;*/
    }
    .dataset{
        display:grid;
        grid-template-columns: 460px 460px;
        margin-top: 10px;
        height: 85%;
    }
    .books-side{

        grid-column: 1;
        height: 100%;

        margin-right:10px;
        border:3px solid black;
        display: grid;
        grid-template-rows: 1fr 1fr 1fr;
    }
    .users-side{
        grid-column:2;
        border:3px solid black;
        height:100%;

    }
    .book1{
        grid-row: 1;
        border-bottom: 2px solid black;
        width:100%;
    }
    .book2{
        grid-row:2;
        border-bottom: 2px solid black;
        width:100%;
    }
    .book3{
        grid-row:3;
        width:100%;
    }
    .book01 .total{
        font-size: 60px;
        display:flex;
        align-items : center;
        justify-content: center;
    }
    .book01 .total-books{
        font-size: 30px;
        display:flex;
        align-items : center;
        justify-content: center;

    }
    .book02 .textt{
        font-size:20px;
        display:flex;
        justify-content: center;
    }
    .value{
        margin-left:20px;
    }

    .tabb {
        background-color: <?php echo SECONDARY_COLOR; ?>;
        color: <?php echo PRIMARY_COLOR; ?>;
        font-size: 30px;
        text-decoration: none;
        text-align: center;
        font-weight: bolder;
        height: 38px;
        margin: 10px;
        border-radius: 10px;
        font-family:Verdana, sans-serif;
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
    <div class ="dataset">
        <div class ="books-side">
            <div class="book01">
                <div class="total">117</div><br>
                <div class="total-books">Total Books</div>
            </div>

            <div class="book02">
                <div class="textt">Available <div class="value">10</div> </div><br>
                <div class="textt">Borrowed <div class="value">17</div></div><br>
                <div class="textt">Overdue <div class="value">7</div></div><br>

            </div>

            <div class="book03">
            <a href = "/../Reportpage/report_page.php"><div class = "tabb">Main Books Report</div>
        </a>';
            </div>


        </div>
        <div class ="users-side">

        </div>


    </div>
</div>


