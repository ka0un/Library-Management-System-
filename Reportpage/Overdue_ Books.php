<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>Overduebooks</title>
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
                                    <th>StaffMember(chechout)</th>
                                    <th>Date(chechout)</th>
                                    <th>Overdued time</th>
                                  

                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>
                                    <td>S005</td>   
                                    <td>2023/05/04</td> 
                                    <td>5</td>  
                                </tr>

                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>
                                    <td>S005</td>   
                                    <td>2023/05/04</td> 
                                    <td>5</td>  
                                </tr>


                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>
                                    <td>S005</td>   
                                    <td>2023/05/04</td> 
                                    <td>5</td>  
                                </tr>


                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>
                                    <td>S005</td>   
                                    <td>2023/05/04</td> 
                                    <td>5</td>  
                                </tr>


                                <tr>
                                    <td>C001</td>
                                    <td>U002</td>
                                    <td>S005</td>   
                                    <td>2023/05/04</td> 
                                    <td>5</td>  
                                </tr>


                                
                                

                                
                            </tbody>
                        </table>
                    </div>
                    
                    

                </div>

                
            </div>
        </div>

    </body>

</html>
