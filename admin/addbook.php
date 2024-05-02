<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';

if (!has_permission($_SESSION['uuid'], 'ADD_BOOK')) {
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
    <div class="add_book_1st_div">
        <h1>Add Book</h1>
        <form action="" method="post">
            <input type="text" id="textbox" class="" placeholder="Enter Name"><br><br>
            <input type="text" id="textbox" class="" placeholder="Enter Auther"><br><br>
            <select id="textbox">
                <option>Horror</option>
                <option>Cooking</option>
                <option>Satire</option>
                <option>Autobiography</option>
                <option>Romance</option>
                <option>Biography</option>
                <option>Fairy tale</option>
                <option>Thriller</option>
                <option>Mystery</option>
                <option>Fantasy</option>
                <option>Comics</option>
            </select>
            <br><br>
            <textarea cols=23 rows=5 id="textarea_addbook">Discription</textarea><br>
            <input type="text" id="textbox" class="no_of_copies" placeholder="Number Of Copies"><br><br>
            <button class="upload_image_button" id="addbook_buttons"><img width="20" height="17" src="https://img.icons8.com/windows/32/1A1A1A/upload.png" alt="upload"/> Upload image</button><br><br>
            <input type="submit" id="addbook_buttons" class="add_book_submit" value="Submit" name="submit">
        </form>
    </div>
</div>

</body>
</html>