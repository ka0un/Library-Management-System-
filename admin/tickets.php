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
    .admin_table {
        width: 100%; 
        border-collapse: collapse;
    }

    .admin_table th,
    .admin_table td {
        border: 2px solid black; 
        padding: 1%; 
        text-align: left; 

    .admin_table th {
        background-color: <?php echo PRIMARY_COLOR; ?>; 
        color: white; 
    }
	#table_div{
		padding-top: 10px; 
        margin-top: 0 auto;
        width: 80%;
	}
    .ticket_delete_button{
        border-radius: 20px;
        border-color: <?php echo SECONDARY_COLOR; ?>;
	    background-color: <?php echo PRIMARY_COLOR; ?>;
	    color:<?php echo SECONDARY_COLOR; ?>;
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
    <form action="" method="POST">
		<div id="table_div">
        <table class="admin_table" border="2px" cellpadding="100px">
            <tr>
                <th>message</th>
                <th>Options</th>
            </tr>
            <tr>
                <td>Hii...kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk</td>
                <td><button class="ticket_delete_button">Delete</button></td>
            </tr>
			<tr>
                <td>Hii...</td>
                <td><button class="ticket_delete_button">Delete</button></td>
            </tr>
        </table>
		</div>
    </form>
</div>