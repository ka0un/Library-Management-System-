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
    <link rel="stylesheet" href="style/login_reg.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <div class="container">

        <?php

        include(__DIR__ . '/sql/users_wrappers.php');

        if(isset($_POST["submit"])){

            $name = $_POST["name"];
            $email = $_POST["email"];
            $nic = $_POST["nic"];
            $password = $_POST["password"];
            $repeate_password = $_POST["repeate_password"];
            
            $error = array();
            if(empty($name) OR empty($email) OR empty($nic) OR empty($password)){
                array_push($error, "Complete all fields");
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($error, "Invalid Email");
            }

            if (strlen($password)<5){
                array_push($error, "Password length must be larger than 5");
            }

            if (is_email_exists($email)){
                array_push($error, "Email Alredy Registered !");
            }

            if(count($error)>0){

                foreach($error as $error){
                    echo "Error : $error";
                }

            }else{

                add_user($name, $email, $nic, $password);
                header("Location: login.php");
                die();
                
            }

        }

        ?>

<center>
		<div class="login_div">
			<form action="register.php" method="post" class="register_form">
				<h1>Register</h1>
				<div class="name_div">
					<input type="text" class="full_name" id="input" placeholder="Full Name" name="name" required><br><br>
				</div>
				<div class="nic_div">
					<input type="text" class="nic_reg" id="input" placeholder="NIC" name="nic" required><br><br>
				</div>
				<div class="email_div">
				<input type="email" class="email_login" id="input" placeholder="Email" name="email" required><br><br>
				</div>
				<div class="password_div">
					<input type="password" placeholder="Password" id="input" name="password" required><br><br>
				</div>
				<div class="confirm_password_div">
					<input type="password" placeholder="Confirm Password" id="input" name="Confirm_password" required><br><br>
				</div>
				<div classs="create_account_div">
					<input type="submit" class="login_submit" id="button" name="submit" id="input" value="Create Account"><br>
				</div>
		
				<p>Alredy have an account?</p>
				
			</form>
            <a href="login.php">
					<button class="sign_in" id="button">Log In</button><br><br>
				</a>
		</div>

	<br><br>
	<p>By creating an account, you agree to our <a href="">terms and conditions.</a></p>
    <script>
    document.getElementById('registrationForm').onsubmit = function(e) {
        var password = document.getElementById('password').value;
        var repeatPassword = document.getElementById('repeatPassword').value;

        if (password !== repeatPassword) {
            e.preventDefault(); // Prevent form submission
            alert('Passwords do not match. Please try again.');
            return false; 
        }

        return true; 
    };
    </script>


</body>
</html>
