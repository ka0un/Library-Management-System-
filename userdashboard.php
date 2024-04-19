<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
        <link rel="stylesheet" href="style/userdashboard.php" type="text/css">
    </head>
    <body>
        <div class="sidebar">
            <br><br><img src="images/img_avatar.png" width="149px" height="150px" alt="Profile Picture" style="border-radius:50%;border:3px solid <?php echo SECONDARY_COLOR; ?>">
            <h2>Full Name</h2>
            <div class="sidebartext">
                Role
            </div><br>
            <div class="sidebarul">
                <ul>
                    <li>Total Books Reserved 22</li>
                    <li>Total Books Returned 9</li>
                    <li>Total Fine Paid 20$</li>
                </ul>
            </div><br><br><br><br><br>
            <button style="border:3px solid <?php echo SECONDARY_COLOR; ?>;font-size:22px;background-color:<?php echo PRIMARY_COLOR; ?>;color:<?php echo SECONDARY_COLOR; ?>;border-radius:60px;width:260px;height:45px;font-size:18px;border-style:solid"><b>Change Password</b></button><br><br>
            <div class="sidebarbutton">
                <button style="border:3px solid <?php echo SECONDARY_COLOR; ?>;background-color:<?php echo SECONDARY_COLOR; ?>;color:<?php echo PRIMARY_COLOR; ?>;font-size:18px;border-radius:60px;width:260px;height:45px;font-size:18px;border-style:solid"><b>Logout</b></button>
            </div><br>
        </div>
        <div class="rightside">
            <div class="boxes">
                <div class="box">
                    Reserved<br>
                    03
                </div>
                <div class="box">
                    Pending<br>
                    01
                </div>
                <div class="box">
                    Overdue<br>
                    01
                </div>
                <div class="box">
                    Total Fine<br>
                    10$
                </div>
            </div><br>
            <div class="table">
                <div class="dashboardheading">
                    <div class="checkoutsection">Checkout Date</div>
                    <div class="booksection">Book</div>
                    <div class="returnsection">Return Date</div>
                    <div class="statussection">Status</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/03/23</div>
                    <div class="booksection">Cherry Book</div>
                    <div class="returnsection">2024/03/26</div>
                    <div class="statussection">Pending</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/03/22</div>
                    <div class="booksection">Online Book</div>
                    <div class="returnsection">-</div>
                    <div class="statussection">Reserved</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/03/21</div>
                    <div class="booksection">Kapila Book</div>
                    <div class="returnsection">-</div>
                    <div class="statussection">Reserved</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/03/20</div>
                    <div class="booksection">Koritha Book</div>
                    <div class="returnsection">2024/03/22</div>
                    <div class="statussection">Overdue (10$)</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/03/20</div>
                    <div class="booksection">Chalani Book</div>
                    <div class="returnsection">-</div>
                    <div class="statussection">Reserved</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/03/26</div>
                    <div class="booksection">The Book</div>
                    <div class="returnsection">2024/03/25</div>
                    <div class="statussection">Returned</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection">2024/01/26</div>
                    <div class="booksection">Random Book</div>
                    <div class="returnsection">2024/02/25</div>
                    <div class="statussection">Returned</div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection"></div>
                    <div class="booksection"></div>
                    <div class="returnsection"></div>
                    <div class="statussection"></div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection"></div>
                    <div class="booksection"></div>
                    <div class="returnsection"></div>
                    <div class="statussection"></div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection"></div>
                    <div class="booksection"></div>
                    <div class="returnsection"></div>
                    <div class="statussection"></div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection"></div>
                    <div class="booksection"></div>
                    <div class="returnsection"></div>
                    <div class="statussection"></div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection"></div>
                    <div class="booksection"></div>
                    <div class="returnsection"></div>
                    <div class="statussection"></div>
                </div>
                <div class="dashboard">
                    <div class="checkoutsection"></div>
                    <div class="booksection"></div>
                    <div class="returnsection"></div>
                    <div class="statussection"></div>
                </div>
            </div>
        </div>
    </body>
</html>