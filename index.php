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
    <H1>Eyaas</H1>
    <H1>Welcome To Homepage</H1>
    <a href="register/logout.php">Logout</a>
    <h1>Naduli</h1>
    
</body>
</html>