<?php

require_once __DIR__ . '/report_table_data_entry.php';
require_once __DIR__ . '/../config.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>StaffActions</title>
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
                    <form class="secondform" action="staff_actions.php" method ="POST">
                        <label>Staff_ID</label><input type="text"><input type="Submit" value ="Filter" name="submit">


                       <br><br>
                    </form>
                    <div class ="table">
                        <table>
                            <thead>
                                <tr>
                                    staff_action_display_filtered($uuid)
                                    <th>STAFF_ID</th>
                                    <th>ACTION</th>
                                    <th>BOOK_ID</th>
                                    <th>DATE</th>
                                    <th>TIME</th>
                                </tr>
                                <?php
                                if (isset($_POST['submit'])) {
                                    $staffid = $_POST['admin_id'];
                                    staff_action_display_filtered($staffid);
                                }

                                staff_action_display();
                                ?>

                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>



                </div>


            </div>
        </div>

    </body>

</html>

