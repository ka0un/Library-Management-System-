<?php
// calculate_average_rating.php

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../database/database.php';

// Assuming you have received bookid from the frontend
$bookid = $_POST['bookid'];

// Calculate average rating for the book
$avg_rating_query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE book_id = '$bookid'";
$result = $conn->query($avg_rating_query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Average Rating: " . $row['avg_rating'];
} else {
    echo "No ratings available for this book";
}

$conn->close();
?>
