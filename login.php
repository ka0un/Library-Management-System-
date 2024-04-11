<?php

require_once __DIR__ . '/config.php';

session_start();
if(isset($_SESSION["token"])){
    header("Location: /index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login_reg.css">
    <title>Login</title>
</head>
<body>

    <div class="container">
<?php

require_once __DIR__ . '/sql/users.php';
require_once __DIR__ . '/sql/token.php';

if(isset($_POST["login"])){

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $error = array();
    if(empty($email) OR empty($password)){
        $error[] = "Complete all fields";
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

                $uuid = get_user_id($email);
                $token = generate_token($uuid);

                $_SESSION["uuid"] = $uuid;
                $_SESSION["token"] = $token;

                header("Location: /index.php");
                die();

            }else{
                echo "Email or Password is Incorrect!";
            }

        }

        
        
    }

}

?>
<center>

<div class="login_div">
    <form action="login.php" method="post" class="login_form">
        <h1>Login</h1>
        <div class = "login-lement">
            <input type="email" id="input" placeholder="Enter Email" name="email" class="email_login" required><br><br>
        </div>
        <div class = "login-lement">
            <input type="password" id="input" placeholder="Enter Password" name="password" class="password_login" required><br><br>
        </div>
        <a href=""> Forget Password? </a><br><br>
        <div class = "login-button">
            <input type="submit" id="button" value="Login" name="login" class="login_submit"><br><br>
        </div>
             Haven't Registered Yet?
    </form>
    <a href="register.php">
                <button id="button" class="create_accout">Create Account</button>
    </a><br><br>
</div>
</body>
</html>
