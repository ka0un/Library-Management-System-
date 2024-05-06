<?php
   require_once __DIR__ . '/report_table_data_entry.php';
   require_once __DIR__ . '/../config.php';
   require_once __DIR__ . '/../database/database.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Returned books</title>
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
                    <form class="secondform">

                        <label>USER_ID</label><input type="text"><input type="Submit" value ="Filter">
                        <br><br>
                    </form>
                    <div class ="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>COPY_ID</th>
                                    <th>USER_ID</th>
                                    <th>StaffMember(return)</th>
                                    <th>Returned_Date</th>

                                    
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                               if (isset($_GET['return'])) {
                                 /*  $startdate = $_GET['startdate'];
                                   $enddate = $_GET['enddate'];*/
                                   @display_filtered_returnedBooks($_GET['startdate'],$_GET['enddate']);
                               }
                               if(isset($_POST['submit'])){
                                   $uuid = $_POST['uuid'];
                                   @filter_BR($uuid);
                               }
                               ?>

                            </tbody>
                        </table>
                    </div>
                    
                    

                </div>

                
            </div>
        </div>

    </body>

</html>
