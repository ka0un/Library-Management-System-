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

if(isset($_POST["submit"])){

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
            echo "<b> You Havent been registered yet! </b>";
            return;
        }

        if (is_password_correct($email, $password)){
            header("Location : index.php");
        }else{
            echo "<b> Email or Password is Incorrect! </b>";
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
    </div>
</body>
</html>