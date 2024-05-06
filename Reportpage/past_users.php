<?php

require_once __DIR__ . '/report_table_data_entry.php';
require_once __DIR__ . '/../config.php';

?><!DOCTYPE html>
<html lang="en">
    <head>

        <title>pastusers</title>
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
                    <form class="secondform" action ="past_users.php" method="POST">
                        <label>Staff_ID</label><input type="text" name ="admin_id"><input type="Submit" value ="Filter" name="submit">


                       <br><br>
                    </form>
                    <div class ="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>NIC</th>
                                    <th>NAME</th>
                                    <th>EMAIL</th>
                                    <th>BANNED_DATE</th>
                                    <th>STAFF_ID</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($_POST['submit'])) {
                                $staffid = $_POST['admin_id'];

                                pastusers_display_filtered($staffid);
                            }

                            pastusers_display();
                            ?>

                            </tbody>
                        </table>
                    </div>



                </div>


            </div>
        </div>

    </body>

</html>


