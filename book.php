<?php
require_once __DIR__ . '/components/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Page</title>
    <link rel="stylesheet" href="style/book.php">
</head>
<body>
<?php
generate_header([
    ['url' => '/books.php', 'text' => 'Books'],
    ['url' => '#', 'text' => 'test']
]);
?>
    <div class="book-container">
        <div class="book-image">
            <img src="images/images.jpg" alt="Book Cover">
        </div>
        <div class="book-info">
            <div class="book-category">
                <span>Category:</span>
                <span>Personal Finance</span>
            </div>
            <div class="book-title">
                <h1>Rich Dad Poor Dad</h1>
            </div>
            <div class="book-author">
                <span>By:</span>
                <span>Robert Kiyosaki and Sharon L.Lechter</span>
            </div>
            <div class="book-description">
                <p>Rich Dad, Poor Dad by Robert T. Kiyosaki is a personal finance book that emphasizes the importance of financial education, teaches how to make money work for you, and challenges traditional beliefs about money.</p>
            </div>
            <div class="book-availability">
                <span>Availability:</span>
                <span>5 Copies Available</span>
            </div>
            <div class="book-reserve">
                <button>Reserve</button>
            </div>
        </div>
    </div>
</body>
</html>
