<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <div class="container">
        <form action="register.php" method="post">
            <div class="name">
                <input type="text" name="name" placeholder="Full Name:">
            </div>
            <div class="email">
                <input type="email" name="email" placeholder="Email:">
            </div>
            <div class="nic">
                <input type="text" name="nic" placeholder="Natinal ID:">
            </div>
            <div class="password">
                <input type="password" name="password" placeholder="Password:">
            </div>
            <div class="password">
                <input type="text" name="repeate_password" placeholder="Repeate Password:">
            </div>
            <div class="submit">
                <input type="submit" name="submit" value="Submit">
            </div>
    </div>
</body>
</html>