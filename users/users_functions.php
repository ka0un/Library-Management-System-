<?php

require_once __DIR__ . '/../database/database.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Add User
function add_user($name, $email, $nic, $password) {
    global $conn;

    if(is_email_exists($email)){
        return;
    }

    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    //bcrypt is designed to resist brute-force and rainbow table attacks.

    $sql = "INSERT INTO users (name, email, nic, password) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    //mysqli_prepare helps us to execute SQL queries securely by separating the SQL code from the user input

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $nic, $password_hash);
                                        // s     s       s     s
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {

        echo "Error adding user.";
    }

    mysqli_stmt_close($stmt);
}

// Function to remove user
function remove_user($id) {
    global $conn;
    $sql = "DELETE FROM users WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {

        echo "Error removing user.";
    }

    mysqli_stmt_close($stmt);
}

// Function to update user
function update_user($id, $name, $email, $nic, $password) {
    global $conn;
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE users SET name = ?, email = ?, nic = ?, password = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $email, $nic, $password_hash, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) == 0) {

        echo "Error updating user.";
    }

    mysqli_stmt_close($stmt);
}

// Function to get user details
function get_user($id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        return $user;
    } else {
        return null;
    }

    mysqli_stmt_close($stmt);
}


function is_email_exists($email) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);

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
            return true; 
        } else {
            return false; 
        }
    } else {
        die("Error checking password: " . mysqli_error($conn));
    }
}