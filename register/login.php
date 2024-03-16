<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: /index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <div class="container">
<?php

include(__DIR__ . '/../users/users_functions.php');

if(isset($_POST["login"])){

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $error = array();
    if(empty($email) OR empty($password)){
        array_push($error, "Complete all fields");
    }

    if(count($error)>0){

        foreach($error as $error){
            echo "Error : $error";
        }

    }else{

        if(!is_email_exists($email)){

            echo "You Havent been registered yet!";
            
        }else{

            if (is_password_correct($email, $password)){
                session_start();
                $_SESSION["user"] = "yes";
                header("Location: /index.php");
                die();
            }else{
                echo "Email or Password is Incorrect!";
            }

        }

        
        
    }

}

?>
        <form action="login.php" method="post">
            <div class = "login-lement">
                <input type="email" placeholder="Enter Email:" name="email" required>
            </div>
            <div class = "login-lement">
                <input type="password" placeholder="Enter Password:" name="password" required>
            </div>
            <div class = "login-button">
                <input type="submit" value="Login" name="login">
            </div>
        </form>
        <br>
            <a href="register.php">register</a>
    </div>
</body>
</html>