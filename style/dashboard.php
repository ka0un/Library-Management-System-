<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family:Inter, sans-serif;
        background-color: <?php echo PRIMARY_COLOR; ?>;
    }

    .container {
        display: flex;
        flex-direction: row;
        margin: 5px;
        font-family:Inter, sans-serif;
        color: <?php echo SECONDARY_COLOR; ?>;
        font-size: 25px;

    }

    .sidebar {
        width: 300px;
        height: 100%;
        display: flex;
        flex-direction: column;
        margin: 5px;
        font-family:Inter, sans-serif;
        background-color: <?php echo PRIMARY_COLOR; ?>;
        color: <?php echo SECONDARY_COLOR; ?>;
        font-size: 25px;
        align-items: center;
        border-radius: 20px;

    }



    .name{
        font-size: 25px;
        font-weight: bolder;
        margin-top: 20px;
        text-align: center;
    }

    .image img {
        object-fit: fill;
        margin-top: 30px;
        border-style: solid;
        border-width: 5px;
        border-radius: 180px;
    }
    .email{
        font-size: 15px;
        margin-top: 5px;
        text-align: center;
    }

    .nic{
        font-size: 20px;
        margin-top: 10px;
        text-align: center;
    }

    .role{
        width: auto;
        font-size: 25px;
        margin-top: 20px;
        text-align: center;
        font-weight: lighter;
        background-color: <?php echo TERTIARY_COLOR; ?>;
        border-radius: 20px;
        border-style: solid;
        border-width: 3px;
    }

    .actions{
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }

    .logout{
        width:260px;
        height:45px;
        font-weight:bold;
        font-size:18px;
        background-color:<?php echo PRIMARY_COLOR; ?>;
        color:<?php echo SECONDARY_COLOR; ?>;
        border-radius: 60px;
        border-color: <?php echo SECONDARY_COLOR; ?>;
        border-style: solid;
    }

    .logout:hover{
        background-color: palevioletred;
        cursor: pointer;
    }

    .right {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        margin: 5px;
        font-family:Inter, sans-serif;
        color: <?php echo SECONDARY_COLOR; ?>;
        font-size: 25px;
        border-radius: 20px;
        background-color: <?php echo PRIMARY_COLOR; ?>;
    }

    .stats{
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .stat{
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        margin-left: 20px;
        width: 160px;
        height: 110px;
        border-radius: 20px;
        align-items: center;
        border-style: solid;
        border-width: 3px;
        border-color: <?php echo TERTIARY_COLOR; ?>;
    }

    .stat-title{
        font-size: 20px;
        font-weight: lighter;
        margin-top: 20px;
    }

    .stat-value{
        margin-top: 4px;
        font-size: 40px;
        font-weight: bolder;
    }

    .tables {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-size: 20px;
    }

    .table-title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
        margin-left: 10px;
        margin-bottom: 10px;
    }

    .table {
        display: flex;
        flex-direction: column;
        margin: 10px; /* sets the space around the table */
        background-color: <?php echo PRIMARY_COLOR; ?>;
        font-size: 15px;
        border-radius: 20px;
        border-color: <?php echo TERTIARY_COLOR; ?>;
    }

    .row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        font-weight: lighter;
    }

    .row-head {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        background-color: <?php echo TERTIARY_COLOR; ?>;
        font-weight: bolder;
    }

    .c1, .c2, .c3, .c4 {
        padding: 5px;
        margin: 5px;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
        .sidebar {
            width: 100%;
        }
        .right {
            width: 100%;
        }
        .stats {
            flex-direction: column;
            justify-content: center;
        }
        .stat {
            margin: 5px;
            width: 90%;
            align-self: center;
        }
        .tables {
            flex-grow: 1;
        }
        .table {
            margin: 5px;
        }
        .c1, .c2, .c3, .c4 {
            width: 100%;
            padding: 5px;
            margin: 5px;
        }
    }







</style>