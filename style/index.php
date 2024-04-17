<?php
header("Content-type: text/css; charset: UTF-8");
require_once __DIR__ . '/../config.php';
?>

<style>

*{box-sizing:border-box}
body{font-family:Verdana, sans-serif;
     background-color:#D9D9D9;
     color:#292929;}
.mySlides{
    display:none
}
img{
    vertical-align:middle
}

.slideshow-container{max-width:1000px;
                     position:relative;
                     margin:auto}

.header_text{font-size:15px;
      padding:8px 12px;
      position:absolute;
      bottom:8px;
      width:100%;
      text-align:center}

.numbertext{font-size:12px;
            padding:8px 12px;
            position:absolute;
            top:0}

.dot{height:15px;
     width:15px;
     margin:5px 2px;
     background-color:#D9D9D9;
     border-radius:50%;
     display:inline-block;
     transition:background-color 0.6s ease}

.active{background-color:#717171}
      
.fade{animation-name:fade;
      animation-duration:1.5s}
      
@keyframes fade{from{opacity:.4} 
                to{opacity:1}}

@media only screen and (max-width:300px) {.header_text{font-size:11px}}

.caption{border:3px solid #D9D9D9;
         font-size:30px;
         font-weight:bold}

table{width:100%;
      border-collapse:collapse}

.table{overflow-y:auto;
       max-height:250px}

.scroll-container{border:3px solid #D9D9D9;
                  overflow-x:auto;
                  white-space:nowrap;
                  padding:10px}
      
.scroll-container .book{padding:10px;
                        display:inline-block}

.announcement{
    background-color: <?php echo TERTIARY_COLOR; ?>;
    padding:10px;
    margin:10px 0;
    text-align:center;
    font-size:20px;
    font-weight:bold;
    color: <?php echo SECONDARY_COLOR; ?>;
    display: flex;
    flex-direction: row;
    border-radius: 20px;
}
.Date-Section{
    display:flex;
    padding:10px;
    margin-right:10px;
    flex-direction: column;
}
.Content-Section{
    display:flex;
    padding:10px;
    flex-direction: column;
}

.title{
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 10px;
    align-self: flex-start;
}

.description{
    font-size: 20px;
    font-weight: lighter;
    align-self: flex-start;
}

.day{
    font-size: 50px;
    font-weight: bold;
}

.month{
    font-size: 20px;
    font-weight: normal;
}

/* hero.css */
.hero {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-image: url('https://images.unsplash.com/photo-1535905557558-afc4877a26fc?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
    background-size: cover;
    height: 500px;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 10px;
    border-radius: 20px;
}

.hero::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(128, 128, 128, 0.3); /* gray transparent overlay */
    z-index: 1; /* place the overlay below the text */
    border-radius: 20px;
}

.hero-text {
    font-size: 2em;
    position: relative;
    z-index: 2; /* place the text above the overlay */
}

.hero-text {
    font-size: 2em;
}

.book{
    padding: 10px;
    display: inline-block;
}
.book img{

    object-fit: cover;
    border-radius: 20px;
}

/* For Mobile Devices*/
@media only screen and (max-width: 600px) {

    body {
        font-size: 16px;
    }

    .announcement{
        flex-direction: column;
    }
    .Date-Section{
        flex-direction: row;
        padding-bottom: 2px;
    }
    .Content-Section{
        padding-top: 3px;
    }

    .day{
        font-size: 15px;
    }
    .month{
        font-size: 15px;
        margin-right: 5px;
    }

    .title{
        align-self: center;
        font-size: 20px;
    }

    .description{
        align-self: center;
        font-size: 15px;
    }

    .hero-text{
        font-size: 1em;
    }

}



</style>