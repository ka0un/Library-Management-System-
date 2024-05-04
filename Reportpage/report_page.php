<?php
require_once __DIR__ . '/../sql/Report_page.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../database/dbsetup.php';
?>


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Report</title>
        <link rel ="stylesheet" href="report_page.css">
    </head>
    <body >


     <div class ="main">
            <div class ="sidebar">
                
            </div>
                    
            <div class ="report">
                <div class="part1">
                    <div class ="mainform">
                        <form>
                            <label >DURATION</label><br><br>
                            <label>Start date </label> <input type ="date" name="startDate"><br><br>
                            <label>End date </label> <input type ="date" name="endDate"><br>
                            <input type ="submit" value ="Get Details" name="submit">
                        </form>
                    </div>
                    

                </div>


                <div class ="part2">
                    <form class="secondform">
                        <label>Filter By BOOK_ID</label>
                        <input type="text"><input type="Submit" value ="Filter"><br><br>
                    </form>
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
                                <tr>
                                    <td>C001</td>
                                    <td>Reserve</td>
                                    <td>U002</td>
                                    <td>2023/04/04</td>
                                    <td>17:12:31</td>
                                </tr>
                                <?php
                                     #get_data_forReport('Reserve','reservations');


                                     #read_data_fromReport();
                                     ?>


                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class ="data">
                        <div class="Action">Borrowed Books -<div class="count">17</div><form><input type ="submit" value="View"></form></div>
                        <div class="Action">Returned Books -<div class="count">15</div><form><input type ="submit" value="View"></form></div>
                        <div class="Action">Reserved Books -<div class="count">5</div><form><input type ="submit" value="View"></form></div>
                        <div class="Action">Overdue Books  -<div class="count">3</div><form><input type ="submit" value="View"></form></div>
                        
                    </div>

                </div>

                
            </div>
        </div>

    </body>

</html>

