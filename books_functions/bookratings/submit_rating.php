<?php
// submit_rating.php

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../config.php';

$conn=getConnection();

// Check if form is submitted and data is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating']) && isset($_POST['bookid'])) {
    // Sanitize and validate input data
    $rating = $_POST['rating'];
    $bookid = $_POST['bookid'];

    // Assuming you have a user ID stored in the session
    $user_id = $_SESSION['uuid']; // Adjust this according to your session variable

    // Insert the rating into the database
    $insert_rating_query = "INSERT INTO ratings (book_id, user_id, rating) VALUES ('$bookid', '$user_id', '$rating')";
    
    if ($conn->query($insert_rating_query) === TRUE) {
        echo "Rating submitted successfully!";
    } else {
        echo "Error: " . $insert_rating_query . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request!";
}

// Redirect the user back to the book page or any other page
// Adjust the URL according to your application flow
header('Location: /book.php?id=' . $bookid);
exit();
?>
