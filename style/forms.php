<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>

<style>
body{
    font-family: Inter, sans-serif;
	text-align:center;
	font-size:20px;
    background-color: <?php echo SECONDARY_COLOR; ?>;
}

.login_div{
	width:480px;
	background-color: <?php echo PRIMARY_COLOR; ?>;
	margin-right:30px;
	margin-top:130px;
    border-radius: 30px;
    padding-bottom: 20px;
}

.login_form{
    font-family: Inter, sans-serif;
	padding-top:0px;
	padding-bottom:30px;
    color: <?php echo SECONDARY_COLOR; ?>;
}

#input{
	width:260px;
	height:30px;
	font-weight: lighter;
	font-size:18px;
    color-scheme: dark;
    color: <?php echo SECONDARY_COLOR; ?>;
    border: <?php echo SECONDARY_COLOR; ?>;
    background-color: transparent;
    border-bottom-style: solid;
    border-bottom-width: 1px;
    border-bottom-color: <?php echo SECONDARY_COLOR; ?>;
    caret-color: <?php echo SECONDARY_COLOR; ?>;
    caret-shape: block;
    margin-bottom: 20px;
}

#input::placeholder{
    color: <?php echo SECONDARY_COLOR; ?>;
}

#input:focus{
    outline: none;
}

#button{
	width:260px;
	height:45px;
	font-weight:bold;
	font-size:18px;
	background-color:<?php echo SECONDARY_COLOR; ?>;
	color:<?php echo PRIMARY_COLOR; ?>;
    border-radius: 60px;
    border-color: <?php echo SECONDARY_COLOR; ?>;
    border-style: solid;
}

#button:hover{
    cursor: pointer;
}

#button2{
    width:260px;
    height:45px;
    font-weight:bold;
    font-size:18px;
    background-color:<?php echo PRIMARY_COLOR; ?>;
    color:<?php echo SECONDARY_COLOR; ?>;
    border-radius: 60px;
    border-color: <?php echo SECONDARY_COLOR; ?>;
    border-style: solid;
}

#button2:hover{
    cursor: pointer;
}

#button2:focus{
    outline: none;
}

h1{
    padding-left: 90px;
    text-align: left;
    padding-top: 20px;
    font-family: Inter, sans-serif;
    font-size: 36px;
    font-weight: 800;
	color: <?php echo SECONDARY_COLOR; ?>;
}

#white{
    font-family: Inter, sans-serif;
    color: <?php echo SECONDARY_COLOR; ?>;
}

/* For Mobile Devices*/
@media only screen and (max-width: 600px) {
    body {
        font-size: 16px;
    }

    .login_div {
        width: 90%;
        margin-right: 0%;
        margin-top: 50px;
    }

    #input {
        width: 80%;
    }

    #button, #button2 {
        width: 80%;
    }

    h1 {
        padding-left: 30px;
    }
}
</style>