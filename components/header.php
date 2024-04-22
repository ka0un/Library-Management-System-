<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../sql/users.php';
session_start();
?>


<style>

    .header{
        font-size: 25px;
        font-family: Inter, sans-serif;
        font-weight: bold;
    }

    .brandname{
        color: <?php echo SECONDARY_COLOR; ?>;
        margin-left: 30px;
        padding-right: 30px;
        text-align: left;
        min-width: 200px;
        padding-top: 32.5px;
        font-size: 30px;
    }

    .part1 {
        height : 100px;
        border-radius:20px;
        display: flex;
        justify-content: space-between;
        background-color:<?php echo PRIMARY_COLOR; ?>;
    }

    .part2 {
        height: 30px;
        background-color: unset;
        margin-left: 18px;
        margin-top: 5px;
    }

    .part2 a{
        color:<?php echo PRIMARY_COLOR; ?>;
        text-decoration-line: none;
    }

    .part2 a:visited {
        color: <?php echo PRIMARY_COLOR; ?>;
    }

    .part2 a:link {
        color: <?php echo PRIMARY_COLOR; ?>;
    }

    .nav {
        display: flex;
        flex-direction: row;
        height: 50px;
        margin-top: 25px;
    }

    .nav a{
        text-decoration-line: none;
        color: <?php echo SECONDARY_COLOR; ?>;
    }

    .nav a:visited {
        color: <?php echo SECONDARY_COLOR; ?>;
    }

    .nav a:link {
        color: <?php echo SECONDARY_COLOR; ?>;
    }

    .navhome{
        margin-top: 10px;
        margin-left: 40px;
    }


    .navbook{
        margin-top: 10px;
        margin-left: 40px;
    }

    .navdashboard{
        margin-top: 10px;
        margin-left: 40px;
    }

    .userimg{
        margin-right: 20px;
        align-self: flex-end;
        margin-bottom: 20px;
    }

    .userimg:hover{
        cursor: pointer;
    }

    .userimg img{
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .login{
        margin-right: 30px;
        align-self: flex-end;
        margin-bottom: 35px;
        color: <?php echo SECONDARY_COLOR; ?>;
    }

    .login a{
        color: <?php echo SECONDARY_COLOR; ?>;
        text-decoration-line: none;
    }

    .login a:visited {
        color: <?php echo SECONDARY_COLOR; ?>;
    }

    .login a:link {
        color: <?php echo SECONDARY_COLOR; ?>;
    }



    /* For Mobile Devices*/
    @media only screen and (max-width: 928px) {

        body {
            font-size: 16px;
        }

        .brandname{
            display: none;
        }
    }

    /* For Mobile Devices*/
    @media only screen and (max-width: 400px) {

        body {
            font-size: 16px;
        }

        .nav{
            left-margin: 5px;
            display: flex;
            justify-content: flex-start;
            font-size: 18px;
            margin-top: 30px;
        }


        .navbook{
            margin-left: 5px;
        }

        .navdashboard{
            margin-left: 5px;
        }

        .navhome{
            margin-left: 10px;
        }

        .brandname{
            display: none;
        }

        .login{
            font-size: 18px;
            margin-bottom: 40px;
        }
    }


</style>

<link rel="stylesheet" href="/style/header.php" type="text/css">
<div class ="header">
    <div class ="part1">
        <div class="brandname">
            <?php echo BRAND_NAME; ?>
        </div>
        <div class="nav">
            <div class ="navhome"><a href ="/index.php">Home</a></div>
            <div class ="navbook"><a href ="/books.php">Books</a></div>
            <div class ="navdashboard"><a href ="/support.php">Support</a></div>
        </div>

        <?php
        if(isset($_SESSION['uuid']))
        {
            echo '<div class ="userimg"> <a href="/dashboard.php"> <img src ="'.get_user_profile_picture_url($_SESSION['uuid'], 60).'"> </a></div>';
        }else{
            echo '<div class="login"><a href="/login.php">Login</a></div>';
        }
        ?>

    </div>

            <?php

//            generate_header([
//                ['url' => '/index.php', 'text' => 'Home'],
//                ['url' => '/about.php', 'text' => 'About'],
//                ['url' => '/contact.php', 'text' => 'Contact']
//            ]);

            function generate_header($pathLinks)
            {

                //if the pathLinks is not empty
                if(!count($pathLinks) == 0)
                {
                   echo "<div class =\"part2\"> <div class =\"path\">";
                }

                foreach($pathLinks as $path)
                {
                    $html .= '<a href = "'.$path['url']. '" > '.$path['text'].' > </a>';
                }

                $html .= '</div></div></div>';

                echo $html;
            }

            ?>



