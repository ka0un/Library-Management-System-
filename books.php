<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/sql/books.php';
require_once __DIR__ . '/sql/copies.php';
require_once __DIR__ . '/sql/categories.php'
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
        <title>Book</title>
        <link rel ="stylesheet" href="style/books.php">
    </head>
    <body bgcolor=<?php echo SECONDARY_COLOR;?>>
    <?php
    generate_header(array());
    ?>
        <div class ="main">
            <div class ="category">
                <div class="searchbar">
                    <form id="searchForm">
                    <div class ="searchbar-container"><input type ="text" id="searchinput" placeholder="Search" ></div>
                    </form>
                </div>
            
                <div class ="categorylist">
                    <form id="categoryForm">

                        <?php
                        function display_categories(){
                            foreach (get_all_categoryids() as $categoryid) {
                                echo '<button type="submit" class="cat-item-button" value="'. get_categroy_name($categoryid) .'">Novels</button>';
                            }
                        }

                        display_categories();
                        ?>

                    </form>
                </div>
            </div>
                    
            <div class ="books">

                <?php

                function display_books($book_id_array){
                    foreach ($book_id_array as $bookid) {
                        echo '<a href="'.get_book_url($bookid).'">';
                        echo '<div class ="book-holder">';
                        echo '<img class="front-image" src="'. get_book_image($bookid) .'" width="100px" height="100px">';
                        echo '<div class="title">'. get_book_title($bookid) .'</div>';
                        echo '</div>';
                        echo '</a>';
                    }
                }

                display_books(get_array_of_bookids());

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get the search term from the POST parameters
                    $searchTerm = $_POST['searchTerm'];

                    //clean the old books
                    echo "<script type='text/javascript'>document.querySelector('.books').innerHTML = '';</script>";

                    //if search term is empty, display all books
                    if (empty($searchTerm)) {
                        display_books(get_array_of_bookids());
                        return;
                    }

                    // Perform the search
                    $bookIds = books_sql_like_search($searchTerm);

                    display_book($bookIds);
                }

                ?>

                <script>
                    // Get the search input element
                    var searchInput = document.getElementById('searchinput');

                    // Get the form element
                    var searchForm = document.getElementById('searchForm');

                    // Listen for input events (which are fired whenever the input changes)
                    searchInput.addEventListener('input', function() {
                        searchForm.submit();
                    });

                </script>


            </div>
        </div>

    </body>

</html>
