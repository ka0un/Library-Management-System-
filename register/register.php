<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <div class="container">

        <?php

        include(__DIR__ . '/../users/users_functions.php');

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
                
            }

        }

        ?>

        <form action="register.php" method="post" id="registrationForm">
            <div class="register-element">
                <input type="text" name="name" placeholder="Full Name:" required>
            </div>
            <div class="register-element">
                <input type="email" name="email" placeholder="Email:" required>
            </div>
            <div class="register-element">
                <input type="text" name="nic" placeholder="Natinal ID:" required>
            </div>
            <div class="register-element">
                <input type="password" name="password" placeholder="Password:" required>
            </div>
            <div class="register-element">
                <input type="text" name="repeate_password" placeholder="Repeate Password:" required>
            </div>
            <div class="register-button">
                <input type="submit" name="submit" value="Submit">
            </div>
        </form>

    </div>
    
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