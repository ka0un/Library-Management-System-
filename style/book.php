<?php
header("Content-type: text/css");
require_once __DIR__ . '/../config.php';
// if your file is in root use : require_once __DIR__ . '/config.php';
?>

<style>

body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
}

.book-container {
    display: flex;
    flex-wrap: wrap;
    width: 80%;
    margin: 50px auto;
    background-color: white;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.book-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.book-info {
    width: 60%;
    padding: 20px;
}

.book-category,
.book-author,
.book-availability {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    font-size: auto;
}

.book-category span:first-child,
.book-author span:first-child,
.book-availability span:first-child {
    font-weight: bold;
    margin-right: 5px;
}

.book-title h1 {
    font-size: 24px; 
    margin-bottom: 15px;
}

.book-description {
    margin-bottom: 20px;
    line-height: 1.6; 
}

.book-reserve button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.book-reserve button:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .book-container {
        flex-direction: column;
    }

    .book-image, .book-info {
        width: 100%;
    }
}
</style>