<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../sql/checkouts.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/users.php';
require_once __DIR__ . '/../validators/checkout.php';
require_once __DIR__ . '/../Reportpage/report_table_data_entry.php';


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

            <h1>Enter User ID</h1>
            <form action="" method="post">
                <?php
                if (isset($_GET['userid'])){
                    echo '<input type="text" name="userid" id="userid" required autocapitalize="characters" value="'.$_GET['userid'].'">';
                }else{
                    echo '<input type="text" name="userid" id="userid" required autocapitalize="characters" >';
                    echo '<script>document.getElementById("userid").focus();</script>';
                }
                ?>
                <br><br>
                <input type="submit" value="Submit">
            </form>


        </div>
        <div class="output1">

            <?php

            //user id form
            if(isset($_POST['userid'])){
                //redirect user to current page with user id parameter
                echo '<script>window.location.href = "/admin/checkout.php?userid='.$_POST['userid'].'";</script>';
            }

            if (isset($_GET['userid'])){
                display_checkout_user($_GET['userid']);
            }

            ?>

        </div>
    </div>
    <div class="part">
        <div class="input">

            <?php

            if (isset($_GET['userid'])){
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
            }

            ?>

        </div>
        <div class="output2">

            <?php

            //copy id form
            if(isset($_POST['copyid'])){
                //redirect user to current page with copy id and user id parameter
                echo '<script>window.location.href = "/admin/checkout.php?userid='.$_GET['userid'].'&copyid='.$_POST['copyid'].'";</script>';
            }

            if (isset($_GET['copyid'])){
                display_checkout_copy($_GET['copyid']);
            }

            ?>

        </div>
    </div>
    <div class="part">
        <div class="output3">

            <?php
            if (isset($_GET['userid']) && isset($_GET['copyid'])){
                display_checkout($_GET['userid'], $_GET['copyid']);
            }
            ?>

        </div>
    </div>
</div>

<?php
function display_checkout_user($userid)
{
    if(!is_uuid_exists($userid)){
        echo 'Enter a valid user id';
        echo '<style> .output1 { background-color: #ffa7bf; } </style>';
        return;
    }

    echo '<img src="'. get_user_profile_picture_url($userid, 60).'" width="100px" height="100px">';
    echo '<br>';
    echo '<h3>'.get_user_name($userid).'<h3>';
    echo '<br>';

    if (has_user_exceeded_checkout_limit($userid)){
        echo 'User has exceeded checkout limit';
        echo '<style> .output1 { background-color: #ffa7bf; } </style>';
    } else {
        echo 'User is eligible to checkout';
        echo '<style> .output1 { background-color: #aaffa7; } </style>';
    }
}


function display_checkout_copy($copyid)
{
    if(!is_copyid_exists($copyid)){
        echo 'Enter a valid copy id';
        echo '<style> .output2 { background-color: #ffa7bf; } </style>';
        return;
    }

    echo '<img src="'. get_book_image(get_copy_bookid($copyid)).'" width="100px" height="100px">';
    echo '<br>';
    echo '<h3>'.get_book_title(get_copy_bookid($copyid)).'<h3>';
    echo '<br>';
    echo 'Condition : '.get_copy_pcondition($copyid);
    echo '<br>';


    if (is_copy_alredy_checked_out($copyid)){
        echo 'Copy is already checked out';
        echo '<style> .output2 { background-color: #ffa7bf; } </style>';
        return;
    }

    if (is_copy_pr($copyid)){
        echo 'Copy is permanently reserved';
        echo '<style> .output2 { background-color: #ffa7bf; } </style>';
        return;
    }


}

function display_checkout($userid, $copyid)
{
    if (!can_user_checkout_copy($userid, $copyid)){
        echo get_reason_why_user_cannot_checkout_copy($userid, $copyid);
        echo '<style> .output3 { background-color: #ffa7bf; } </style>';
        return;
    }else{
        echo '<style> .output2 { background-color: #aaffa7; } </style>';
        echo '<style> .output3 { background-color: #aaffa7; } </style>';
    }

    echo '<form action="" method="post" id="checkout">';
    echo '<input type="submit" value="Checkout" name="checkout">';
    echo '</form>';

    //handle button click
    if (isset($_POST['checkout'])){

        add_checkout($copyid, $userid);
        add_checkout_report($copyid, $userid);
        staff_action_with_book($_SESSION['uuid'],$copyid,'Checkout');

        //if copy is reserved, invalidate reservation
        if (is_user_reserved_book($userid, get_copy_bookid($copyid))){
            invalidate_reservation(get_reservation_id($userid, get_copy_bookid($copyid)));
        }

        //redirect user to current page without parameters
        echo '<script>window.location.href = "/admin/checkout.php";</script>';


        echo 'Copy checked out';
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
