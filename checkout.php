<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
        <link rel="stylesheet" href="style/checkout&return.php" type="text/css">
    </head>
    <body>
        <div class="content">
        <div class="usernic"><br>
            <div class="form">
                <form method="post">
                    <div class="textbox">
                        <input type="text" name="nic" placeholder="User NIC" style="border:3px solid <?php echo SECONDARY_COLOR; ?>;font-size:18px;width:185px;height:30px;font-weight:lighter;color-scheme:dark;background-color:transparent">
                    </div><br>
                    <div class="formsubmit">
                        <input type="submit" value="Submit" style="background-color:<?php echo SECONDARY_COLOR; ?>;color:<?php echo PRIMARY_COLOR; ?>;border:3px solid <?php echo SECONDARY_COLOR; ?>;border-radius:60px;font-weight:bold;width:185px;height:30px;font-size:18px;border-style:solid">
                    </div>
                </form>
            </div><br><br>
            <div class="profilepic">
                <img src="images/img_avatar.png" alter="Profile Picture" height="150px" width="149px" style="border:3px solid <?php echo SECONDARY_COLOR; ?>">
            </div><br><br>
            <div class="usernictext">
                Info:<br>
                User Name: KASUN<br>
                Email: kasun@hapangama.com
            </div>
        </div>
        <div class="copyid"><br>
            <div class="form">
                <form method="post">
                    <div class="textbox">
                        <input type="text" name="copyid" placeholder="Copy ID" style="border:3px solid <?php echo SECONDARY_COLOR; ?>;font-size:18px;width:185px;height:30px;font-weight:lighter;color-scheme:dark;background-color:transparent">
                    </div><br>
                    <div class="formsubmit">
                        <input type="submit" value="Submit" style="background-color:<?php echo SECONDARY_COLOR; ?>;color:<?php echo PRIMARY_COLOR; ?>;border:3px solid <?php echo SECONDARY_COLOR; ?>;border-radius:60px;font-weight:bold;width:185px;height:30px;font-size:18px;border-style:solid">
                    </div>
                </form>
            </div><br><br>
            <div class="copy">
                <img src="images/book1.jpeg" alter="Profile Picture" height="200px" width="150px" style="border:3px solid <?php echo SECONDARY_COLOR; ?>">
            </div><br><br>
            <div class="copyidtext">
                Info:<br>
                Book Name: Madol Duwa<br>
                Author: Martin Wickremasinghe<br>
                Book ID: 22
            </div>
        </div>
        <div class="status"><br>
            <div class="statusbox"><br>
                Status<br>
                <img width="17" height="17" src="https://img.icons8.com/material-rounded/24/FFFFFF/checkmark--v1.png" alt="checkmark--v1"/> Ready for Checkout<br><br>
            </div><br><br>
            <div class="statustext">
                Info:<br>
                Return Date: 22/04/2024
            </div><br><br>
            <div class="statusbutton">
                <button style="background-color:<?php echo SECONDARY_COLOR; ?>;color:<?php echo PRIMARY_COLOR; ?>;border:3px solid <?php echo SECONDARY_COLOR; ?>;border-radius:60px;font-weight:bold;width:185px;height:35px;font-size:15px;border-style:solid"><img width="13" height="13" src="https://img.icons8.com/ios-glyphs/30/checkmark--v1.png" alt="checkmark--v1"/> Confirm Checkout</button>
            </div>
        </div>
        </div>
        <script src="scripts/checkout&return.js"></script>
    </body>
</html>