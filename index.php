<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: /register/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <H1>Welcome To Homepage</H1>
</body>
</html>