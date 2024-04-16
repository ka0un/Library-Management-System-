<?php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';


$conn = getConnection();



// Add User
function add_user($name, $email, $nic, $password): void
{
    global $conn;

    if (is_email_exists($email)) {
        return;
    }

    //[*] we are using PASSWORD_BCRYPT algorithm for encrypt our user's passwords and store them safely and securely
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    //doc : https://www.php.net/manual/en/function.password-hash.php

    $uuid = generate_uuid();
    

    $sql = "INSERT INTO users (uuid, name, email, nic, password) VALUES (?, ?, ?, ?, ?)";

    //[*] we can avoid sql injection attacks by using prepair and bind param functions insted of string concatnation !   
    $stmt = mysqli_prepare($conn, $sql);
    //doc : https://www.php.net/manual/en/mysqli.prepare.php
    mysqli_stmt_bind_param($stmt, "sssss", $uuid, $name, $email, $nic, $password_hash);
    //doc : https://www.php.net/manual/en/mysqli-stmt.bind-param.php
    mysqli_stmt_execute($stmt);
    //doc : https://www.php.net/manual/en/mysqli-stmt.execute.php

    //doc : https://www.php.net/manual/en/mysqli-stmt.affected-rows.php
    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error adding user.";
    }

    //doc : https://www.php.net/manual/en/mysqli-stmt.close.php
    mysqli_stmt_close($stmt);
}

// Function to remove user
function remove_user($id): void
{
    global $conn;
    $sql = "DELETE FROM users WHERE uuid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error removing user.";
    }

    mysqli_stmt_close($stmt);
}

// Function to update user details
function update_user_details($id, $name, $email, $nic): void
{
    global $conn;
    
    $sql = "UPDATE users SET name = ?, email = ?, nic = ? WHERE uuid = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $nic, $id);
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error updating user details.";
    }
    
    mysqli_stmt_close($stmt);
}

// Function to change user password
function change_user_password($id, $password): void
{
    global $conn;
    
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET password = ? WHERE uuid = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $password_hash, $id);
    mysqli_stmt_execute($stmt);
    
    if (mysqli_stmt_affected_rows($stmt) == 0) {
        echo "Error changing user password.";
    }
    
    mysqli_stmt_close($stmt);
}

function is_uuid_exists($uuid): bool
{
    global $conn;
    $uuid = mysqli_real_escape_string($conn, $uuid);
    // doc : https://www.w3schools.com/Php/func_mysqli_real_escape_string.asp

    $sql = "SELECT COUNT(*) FROM users WHERE uuid = '$uuid'";
    $result = mysqli_query($conn, $sql);

    $count = mysqli_fetch_row($result)[0];
    return $count > 0;
}


// Function to get user name by UUID
function get_user_name($uuid) {
    global $conn;
    $sql = "SELECT name FROM users WHERE uuid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['name'];
    } else {
        return null;
    }


}

// Function to get user email by UUID
function get_user_email($uuid) {

    global $conn;
    $sql = "SELECT email FROM users WHERE uuid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['email'];
    } else {
        return null;
    }

}

// Function to get user ID
function get_user_id($email) : string
{
    global $conn;
    $sql = "SELECT uuid FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result)['uuid'];

}

// Function to get user NIC by UUID
function get_user_nic($uuid) {
    global $conn;
    $sql = "SELECT nic FROM users WHERE uuid = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uuid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['nic'];
    } else {
        return null;
    }

}

function get_user_profile_picture_url($uuid, $size): string
{
    return get_default_user_profile_picture_url($uuid, $size);
}

function get_default_user_profile_picture_url($uuid, $size): string
{
    $username = get_user_name($uuid);
    $usernamewithoutspaces = str_replace(' ', '+', $username);

    if ($uuid === null){
        return "/../images/profile.png";
    }

    if (USE_API_TO_DEFAULT_PROFILE_PICTURE){
        return "https://ui-avatars.com/api/?background=random&name=". $usernamewithoutspaces . "&rounded=true&bold=true&size=" . $size;
    }else{
        return "/../images/profile.png";
    }


}


function is_email_exists($email): bool
{
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    // doc : https://www.w3schools.com/Php/func_mysqli_real_escape_string.asp

    $sql = "SELECT COUNT(*) FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    $count = mysqli_fetch_row($result)[0];
    return $count > 0;
}

function is_password_correct($email, $enteredPassword) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // we can use password_verify function to check if saved password matches the hashed password
        if ($row && password_verify($enteredPassword, $row['password'])) {
            //doc : https://www.php.net/manual/en/function.password-verify.php
            return true;
        } else {
            return false;
        }
    } else {
        die("Error checking password: " . mysqli_error($conn));
    }
}

// Function to generate UUID
function generate_uuid(): string
{
    global $conn;

    // Count the number of rows in the table
    $sql = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $row_count = $row['COUNT(*)'];

    // Increment the row count to get the next UUID number
    $next_uuid_number = $row_count + 1;

    // Format the UUID with leading zeros
    //doc : https://www.php.net/manual/en/function.sprintf.php
    //guide : https://www.w3schools.com/php/func_string_sprintf.asp

    return 'U' . sprintf('%07d', $next_uuid_number);
}

