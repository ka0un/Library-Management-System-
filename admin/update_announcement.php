<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';

if (!has_permission($_SESSION['uuid'], 'VIEW_ADMIN_DASHBOARD')) {
    header("Location: /index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style/book.php">

</head>


<style>
.panel{
        background-color: <?php echo TERTIARY_COLOR; ?>;
        color: <?php echo PRIMARY_COLOR; ?>;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        margin-left: 10px;
        border-radius: 10px;
        height: 85%;
        font-family:Verdana, sans-serif;
        font-weight: bold;
        font-size: 14px;
    }
.announce{display:flex;
          flex-wrap:nowrap;
          background-color:#292929;
          color:#D9D9D9;
          font-family:Verdana, sans-serif;
          font-size:20px;
          text-align:center}
.updateannounce,.activeannounce{border:3px solid #D9D9D9;
                                padding:25px}
.title2{border:3px solid #D9D9D9;
        font-size:18px;
        width:185px;
        height:30px;
        font-weight:lighter;
        color-scheme:dark;
        background-color:transparent}
.description2{border:3px solid #D9D9D9;
              font-size:18px;
              font-weight:lighter;
              color-scheme:dark;
              background-color:transparent}
.expiredate2{border:3px solid #D9D9D9;
             font-size:18px;
             height:30px;
             font-weight:lighter;
             color-scheme:dark;
             background-color:transparent}
.updatebutton2,.deletebutton2{border-radius:60px;
                              background-color:#D9D9D9;
                              color:#292929;
                              border:3px solid #D9D9D9;
                              font-weight:bold;
                              width:185px;
                              height:30px;
                              font-size:18px;
                              border-style:solid}
.searchbox2{border:3px solid #D9D9D9;
            font-size:18px;
            width:185px;
            height:30px;
            font-weight:lighter;
            color-scheme:dark;
            background-color:transparent;
            border-radius:60px}
.searchbutton{background-color:transparent;
              border:3px solid #D9D9D9;
              position:relative;
              top:6px}
.form,.searchbox1{border:3px solid #D9D9D9}
</style>

<body bgcolor="<?php echo SECONDARY_COLOR;?>">
<?php

generate_header(array());

?>

<?php
include( __DIR__ . '/../components/sidebar.php');
?>

<div class="panel">
<div class="announce">
            <div class="updateannounce">
                <div>
                    <h2>Update Announcement</h2>
                </div>
                <div class="searchbox1"><br>
                    <input type="text" name="search" placeholder="Announcement ID" class="searchbox2">
                    <button class="searchbutton"><img width="27" height="27" src="https://img.icons8.com/ios/50/FFFFFF/search--v1.png" alt="search--v1"/></button><br><br>
                </div><br>
                <div class="form">
                    <form action="" method="post">
                        <div class="title1"><br>
                            <input type="text" name="title" placeholder="Title" class="title2">
                        </div><br>
                        <div class="description1">
                            <textarea cols="17" rows="10" placeholder="Description" class="description2"></textarea>
                        </div><br>
                        <div class="expiredate1">
                            <lebel for="expiredate">Expire Date: </lebel>
                            <input type="datetime-local" placeholder="Expire Date" class="expiredate2">
                        </div><br>
                        <div class="updatebutton1">
                            <input type="submit" value="Update" class="updatebutton2">
                        </div><br>
                    </form>
                    <form>
                        <div class="deletebutton1">
                            <input type="submit" value="Delete" class="deletebutton2">
                        </div><br>
                    </form>
                </div>
            </div>
            <div class="activeannounce"><br><br><br><br>
                <div>
                    <h2>Active Announcements</h2>
                </div>
                <div>
                    <table border="3px">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</div>