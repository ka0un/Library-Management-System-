<?php
   require_once __DIR__ . '/report_table_data_entry.php';
   require_once __DIR__ . '/../config.php';
   require_once __DIR__ . '/../database/database.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Reserved books</title>
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
                    <form class="secondform" action ="Reserved_books.php" method="post">
                        <label>USER_ID</label><input type="text"><input type="Submit" value ="Filter" name="submit"><br><br>

                    </form>
                    <div class ="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>COPY_ID</th>
                                    <th>USER_ID</th>
                                    <th>Rserved_Date </th>
                                    <th>Dead_LINE</th>
                                  

                                    
                                </tr>
                            </thead>

                            <tbody>
                           <?php
                           if (isset($_GET['reserve'])) {
                               $startdate = $_GET['startdate'];
                               $enddate = $_GET['enddate'];
                               @display_filtered_reservedBooks($startdate,$enddate);
                           }
                           if(isset($_POST['submit'])){
                               $uuid = $_POST['uuid'];
                               @filter_reserve($uuid);
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
 <tr>
                                    <td>C001</td>
                                    <td>U002</td>
                                    <td>2023/04/04</td>
                                    <td>2023/05/04</td>
                                </tr>

                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>

                                    <td>2023/04/04</td>
                                    <td>2023/05/04</td>
                                </tr>

                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>

                                    <td>2023/04/04</td>
                                    <td>2023/05/04</td>
                                </tr>

                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>

                                    <td>2023/04/04</td>
                                    <td>2023/05/04</td>
                                </tr>

                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>

                                    <td>2023/04/04</td>
                                    <td>2023/05/04</td>
                                </tr>