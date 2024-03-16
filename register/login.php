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
    	<div class="login_border">
	<div class="login_div">
        <form action="login.php" method="post" class="login_form">
			<h1>Login</h1>
			<div class = "login-lement">
				<input type="email" placeholder="Enter Email" name="email" class="email_login" required><br><br>
			</div>
			<div class = "login-lement">
				<input type="password" placeholder="Enter Password" name="password" class="password_login" required><br><br>
			</div>
			<a href=""> Forget Password? </a><br><br>
			<div class = "login-button">
				<input type="submit" value="Login" name="login" class="login_submit"><br><br>
			</div>
				<a href=""> Havent Registered Yet? </a>
        </form>
		<a href="register.php">
					<button class="create_accout">Create Account</button>
		</a><br><br>
	</div>
	</div>
	<br>
		<p>If you are having issues, feel free to <a href="">Contact Us!</a>
		
			
</body>
</html>