<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../sql/checkouts.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/users.php';
require_once __DIR__ . '/../validators/checkout.php';


if (!has_permission($_SESSION['uuid'], 'RETURN')) {
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

    .output1 {
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

    .output2 {
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

    .output3 {
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

            <?php

            echo '<h1>Enter Copy ID</h1>';
            echo '<form action="" method="post">';
            if (isset($_GET['copyid'])){
                echo '<input type="text" name="copyid" id="copyid" required autocapitalize="characters" value="'.$_GET['copyid'].'">';
            }else{
                echo '<input type="text" name="copyid" id="copyid" required autocapitalize="characters" >';
            }
            echo '<br><br>';
            echo '<input type="submit" value="Submit">';
            echo '</form>';

            //js for focus cursor to copy id input
            echo '<script>document.getElementById("copyid").focus();</script>';

            ?>

        </div>
        <div class="output2">

            <?php

            //copy id form
            if(isset($_POST['copyid'])){
                //redirect user to current page with copy id and user id parameter
                echo '<script>window.location.href = "/admin/checkout.php?&copyid='.$_POST['copyid'].'";</script>';
            }

            if (isset($_GET['copyid'])){
                display_return_copy($_GET['copyid']);
            }

            ?>

        </div>
    </div>
    <div class="part">
        <div class="output3">

            <?php
            if (isset($_GET['userid']) && isset($_GET['copyid'])){
                display_return($_GET['userid'], $_GET['copyid']);
            }
            ?>

        </div>
    </div>
</div>

<?php


function display_return_copy($copyid)
{
    if(!is_copyid_exists($copyid)){
        echo 'Enter a valid copy id';
        echo '<style> .output2 { background-color: #ffa7bf; } </style>';
        return;
    }

    if (!is_copy_alredy_checked_out($copyid)){
        echo 'Copy is not already checked out';
        echo '<style> .output2 { background-color: #ffa7bf; } </style>';
        return;
    }

    $checkoutid = get_checkout_id($copyid);

    echo '<h3> Book<h3>';
    echo '<br>';
    echo '<img src="'. get_book_image(get_copy_bookid($copyid)).'" width="100px" height="100px">';
    echo '<br>';
    echo 'Title : '.get_book_title(get_copy_bookid($copyid));
    echo 'Condition : '.get_copy_pcondition($copyid);
    echo '<br>';
    echo '<h3> User<h3>';
    echo '<br>';
    echo '<img src="'. get_user_profile_picture_url(get_checkout_uuid($checkoutid), 60).'" width="100px" height="100px">';
    echo '<br>';
    echo 'Name : '.get_user_name(get_checkout_uuid($checkoutid)).'<h3>';
    echo '<br>';


}

function display_return($copyid)
{
    $checkoutid = get_checkout_id($copyid);
    $userid = get_checkout_uuid($checkoutid);

    if (is_checkout_time_exceeded($checkoutid)){
        echo '<h3>Checkout time exceeded</h3>';
        echo '<br>';
        echo 'checkout date : '.get_checkout_start($checkoutid);
        echo '<br>';
        echo 'checkout duration : '.date("H:i:s", MAX_CHECKOUT_SECOUNDS);
        echo '<br>';
        echo 'Fine : '.get_checkout_fine($checkoutid);
        echo '<br>';
        echo '<style> .output3 { background-color: #ffa7bf; } </style>';

        echo '<form action="" method="post" id="return_with_fine">';
        echo '<input type="checkbox" name="confirm" value="confirm">';
        echo '<input type="submit" value="Confirm Return" name="checkout" disabled> ';
        echo '</form>';

        return;
    }

    echo '<h3>Book Returned On Time!</h3>';
    echo '<br>';
    echo 'checkout date : '.get_checkout_start($checkoutid);
    echo '<br>';
    echo 'checkout duration : '.date("H:i:s", MAX_CHECKOUT_SECOUNDS);
    echo '<br>';
    echo '<style> .output3 { background-color: #aaffa7; } </style>';


    echo '<form action="" method="post" id="return">';
    echo '<input type="submit" value="Confirm Return" name="checkout">';
    echo '</form>';

    //handle return
    if (isset($_POST['return'])) {
        invalidate_checkout(get_checkout_id($copyid));
        echo '<script>window.location.href = "/admin/return.php";</script>';
    }

    //handle return with fine
    if (isset($_POST['return_with_fine'])) {
        if (isset($_POST['confirm'])) {
            invalidate_checkout(get_checkout_id($copyid));
            echo '<script>window.location.href = "/admin/return.php";</script>';
        }
    }

}

?>

<!--js that auto submit the form once x amount of characters enters to the form-->
<script>
    document.getElementById('userid').addEventListener('input', function (e) {
        if (e.target.value.length === 8) {
            e.target.form.submit();
        }
    });

    document.getElementById('copyid').addEventListener('input', function (e) {
        if (e.target.value.length === 8) {
            e.target.form.submit();
        }
    });
</script>

<!--js to enable the button once the checkbox is checked-->
<script>
    document.getElementById('return_with_fine').addEventListener('input', function (e) {
        if (e.target.value === 'confirm') {
            document.getElementById('checkout').disabled = false;
        }
    });