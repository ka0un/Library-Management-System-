<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/sql/books.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/sql/books.php';
require_once __DIR__ . '/components/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <link rel="stylesheet" href="style/index.php" type="text/css">
    <title>Home</title>
</head>
<body>
<?php
@generate_header(array());
?>
<div class="hero">
    <div class="hero-text">
        <h1>Welcome to the Library Management System</h1>
        <p>Explore our collection of books, reserve and checkout your favorites, and enjoy the magic of reading!</p>
    </div>
</div>
<?php
 function display_announcement($month, $day, $title, $description){
     echo '<div class="announcement">';
     echo '<div class="Date-Section">';
     echo '<div class="month">';
     echo $month;
     echo '</div>';
     echo '<div class="day">';
     echo $day;
     echo '</div>';
     echo '</div>';
     echo '<div class="Content-Section">';
     echo '<div class="title">';
     echo '<b>';
     echo $title;
     echo '</b>';
     echo '</div>';
     echo '<div class="description">';
     echo $description;
     echo '</div>';
     echo '</div>';
     echo '</div>';
 }
    display_announcement('NOV', '10', 'Overdue Bandit Alert!', 'Our shelves are feeling a little lighter than usual. Did you accidentally become best friends with a library book?');
    display_announcement('OCT', '26', 'Shh! We\'re Having a Silent Reading Dance Party (Don\'t Tell the Shhh-Police)', 'Ever get the urge to bust a move while buried in a good book? Us too! Join us for a silent reading dance party –  find a comfy corner, crank up the internal soundtrack, and let your bookish joy flow freely (without disturbing the peace, of course!).');
    display_announcement('OCT', '26', 'We Now Accept Squirrel Currency!', 'We may not have an official acorn exchange program (yet!).');
?>

<div class="popbook">
    <div class="caption">
        Popular Books
    </div>
    <div class="scroll-container">
        <?php
        require_once __DIR__ . '/sql/books.php';
        $booksid1 = 'B0000001';
        $booksid2 = 'B0000002';
        function display_book($booksid){
            echo '<div class="book">';
            echo '<a href="'.get_book_url($booksid).'"><img src="'.get_book_image($booksid).'" alt="Book Image" height="300px" width="200px"></a>';
            echo '</div>';
        }
        display_book($booksid1);
        display_book($booksid2);
        display_book($booksid1);
        display_book($booksid2);
        display_book($booksid1);
        display_book($booksid2);
        display_book($booksid1);
        display_book($booksid2);
        display_book($booksid1);
        display_book($booksid2);
        display_book($booksid1);
        display_book($booksid2);
        ?>
    </div>
</div>
</body>
</html>
?>