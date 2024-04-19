<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>
<style>
.sidebar{border:3px solid <?php echo SECONDARY_COLOR; ?>;
         text-align:center;
         width:30%;
         position:absolute;
         bottom:5px;
         top:5px;
         border-radius:20px;
         background-color:<?php echo PRIMARY_COLOR; ?>}
.sidebartext{border:3px solid <?php echo SECONDARY_COLOR; ?>;
             border-radius:20px;
             margin-left:40%;
             margin-right:40%;
             font-size:22px;
             font-weight:bold}
.sidebarul{display:inline-block;
           text-align:left;
           font-size:20px}
.rightside{position:absolute;
           left:31%}
body{font-family:Inter,sans-serif;
     background-color:<?php echo SECONDARY_COLOR; ?>;
     color:<?php echo SECONDARY_COLOR; ?>}
.boxes{display:flex;
       flex-wrap:nowrap}
.boxes > div {width:240px;
              margin:10px;
              text-align:center;
              line-height:75px;
              border:3px solid <?php echo SECONDARY_COLOR; ?>;
              font-size:30px;
              font-weight:bold;
              border-radius:20px;
              background-color:<?php echo PRIMARY_COLOR; ?>}
.dashboard{display:flex;
           flex-direction:row;
           border:3px solid <?php echo SECONDARY_COLOR; ?>;
           font-size:20px;
           text-align:center;
           padding:10px;
           justify-content:space-between;
           margin-left:10px;
           margin-right:10px;
           height:17px;
           align-items:center;
           background-color:<?php echo PRIMARY_COLOR; ?>}
.dashboardheading{display:flex;
                  flex-direction:row;
                  border:3px solid <?php echo SECONDARY_COLOR; ?>;
                  font-weight:bold;
                  font-size:20px;
                  text-align:center;
                  padding:10px;
                  justify-content:space-between;
                  margin-left:10px;
                  margin-right:10px;
                  height:30px;
                  align-items:center;
                  background-color:<?php echo PRIMARY_COLOR; ?>}
.checkoutsection{display:flex;
                 flex-direction:column}
.statussection{display:flex;
               flex-direction:column}
.booksection{display:flex;
             flex-direction:column}
.returnsection{display:flex;
               flex-direction:column}
.table{max-height:552px;
       overflow-y:auto}
@media screen and (max-width:1925px){.sidebar{width:30%}
                                     .rightside{width:70%}}
@media screen and (max-width:1000px){.sidebar{width:100%}
                                     .rightside{width:100%;
                                                position:relative;
                                                top:725px;
                                                left:0}}
@media screen and (max-width:650px){.boxes{flex-direction:column}
                                    .box{width:100%}}
</style>
       


      
                      