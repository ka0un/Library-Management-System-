<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>
<style>
.content{display:flex;
         flex-wrap:nowrap;
         position:absolute;
         left:350px;
         top:100px}
.content > div {border:3px solid <?php echo SECONDARY_COLOR; ?>;
                text-align:center;
                padding:25px 75px 25px 75px;
                background-color:<?php echo PRIMARY_COLOR; ?>;
                color:<?php echo SECONDARY_COLOR; ?>;
                font-family:Inter,sans-serif}
.copyidtext,.usernictext,.statustext{text-align:left}
.statusbox{border:3px solid <?php echo SECONDARY_COLOR; ?>}
</style>
