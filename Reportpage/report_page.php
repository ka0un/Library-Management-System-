<?php
require_once __DIR__ . '/report_table_data_entry.php';
require_once __DIR__ . '/../config.php';




?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Report</title>
        <link rel ="stylesheet" href="report_page.css">
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
                    <div class ="mainform">
                        <form action='report_page.php' method='post'>
                            <label >DURATION</label><br><br>
                            <label>Start date </label> <input type ="date" name='startDate'><br><br>
                            <label>End date </label> <input type ="date" name="endDate"><br>
                            <input type ="submit" value ="Get Details" name='submit_duration'>
                        </form>
                    </div>


                </div>


                <div class ="partt2">


                        <?php
                           if (isset($_POST['submit_duration'])) {
                                echo "<form class='secondform' action='report_page.php' method='post'>";
                                echo "<label>Filter By BOOK_ID</label>";
                                echo "<input type='text'>";
                                echo "<input type='submit' value='Filter' name='submit'> <br><br>";
                                echo "</form>";
                           }
                        ?>


                    <div class ="table">
                        <table>
                            <thead>
                                <tr>
                                    <th>COPY_ID</th>
                                    <th>ACTION</th>
                                    <th>USER_ID</th>
                                    <th>DATE</th>
                                    <th>TIME</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    if (isset($_POST['submit_duration'])) {
                                     $startDate=$_POST['startDate'];
                                     $endDate=$_POST['endDate'];
                                     @filterByDate_fromReport($startDate, $endDate);
                                    }

                                    if (isset($_POST['submit'])) {
                                     $uuid = $_POST['uuid'];
                                     @filter_tempory_books_report($uuid);
                                    }
                                    @display_main_report();


                                ?>


                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class ="data">
                        <div class="Action">Borrowed Books -<div class="count">17</div><form action='borrowed_books.php?startdate=<?php echo urlencode($startDate); ?>&enddate=<?php echo urlencode($endDate); ?>' method="get">
                        <input type="submit" value="View" name="borrow"></form></div>

                        <div class="Action">Returned Books -<div class="count">15</div><form action='Returned_books.php?startdate=<?php echo urlencode($startDate); ?>&enddate=<?php echo urlencode($endDate); ?>' method="get"><input type ="submit" value="View" name ="return"></form></div>
                        <div class="Action">Reserved Books -<div class="count">5</div><form action='Reserved_books.php?startdate=<?php echo urlencode($startDate); ?>&enddate=<?php echo urlencode($endDate); ?>' method="get"><input type ="submit" value="View" name ="reserve"></form></div>
                        /*<div class="Action">Overdue Books  -<div class="count">3</div><form ><input type ="submit" value="View"></form></div>*/





                    </div>

                </div>


            </div>
        </div>

    </body>

</html>