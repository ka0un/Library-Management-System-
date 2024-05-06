<?php

require_once __DIR__ . '/report_table_data_entry.php';
require_once __DIR__ . '/../config.php';

?><!DOCTYPE html>
<html lang="en">
    <head>

        <title>Login/logout</title>
        <link rel ="stylesheet" href ="subpages.css">
    </head>
    <body >
         <div class="header">
            <?php
            include( __DIR__ . '/../components/header.php');
            @generate_header(array());
           ?>
        </div>
        <div class ="main">
            <div class ="sidebar">
                            <?php
@include( __DIR__ . '/../components/sidebar.php');
?>
            </div>

            <div class ="report">
                <div class="partt1">

                    head.....................................................

                </div>
                <div class ="partt2">
                    <form class="secondform" action ="userslogin_logout.php" method="POST">
                        <label>USER_ID</label><input type="text" name ="userID"><input type="Submit" value ="Filter" name ="submit">

                       <br><br>
                    </form>
                    <div class ="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Session</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             if (isset($_POST['submit'])) {
                                $userid = $_POST['userID'];

                                userlogin_logout_display_filtered($userid);
                            }
                            userlogin_logout_display();
                            ?>

                            </tbody>
                        </table>
                    </div>



                </div>


            </div>
        </div>

    </body>

</html>

