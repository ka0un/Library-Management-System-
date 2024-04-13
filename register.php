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
    <link rel="stylesheet" href="style/forms.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body style="background-color: <?php echo SECONDARY_COLOR; ?>;">
    <div class="container">

        <?php

        require_once __DIR__ . '/sql/users.php';

        if(isset($_POST["submit"])){

            $name = $_POST["name"];
            $email = $_POST["email"];
            $nic = $_POST["nic"];
            $password = $_POST["password"];
            
            $error = array();
            if(empty($name) OR empty($email) OR empty($nic) OR empty($password)){
                $error[] = "Complete all fields";
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error[] = "Invalid Email";
            }

            if (strlen($password)<5){
                $error[] = "Password length must be larger than 5";
            }

            if (is_email_exists($email)){
                $error[] = "Email Alredy Registered !";
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
		<div class="form_dev">
			<form action="register.php" method="post" class="register_form" id="form">
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
					<input type="password" placeholder="Confirm Password" id="input" name="confirm_password" required><br><br>
				</div>
				<div classs="create_account_div">
					<input type="submit" class="login_submit" id="button" name="submit" id="input" value="CREATE ACCOUNT"><br>
				</div>
		
				<p id="white">Alredy have an account?</p>
				
			</form>
            <a href="login.php">
					<button class="sign_in" id="button2">LOG IN</button><br><br>
				</a>
		</div>

	<br><br>
	<p>By creating an account, you agree to our <a href="">terms and conditions.</a></p>
    <script>
    
    // pasword & repeate password validation script removed !

    </script>


</body>
</html>
