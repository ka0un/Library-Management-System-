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
                    <div class ="searchbar-container">
                        <datalist id="searchlist">
                            <?php
                            foreach (get_array_of_bookids() as $id) {
                                echo '<option value="'. get_book_title($id) .'">';
                                echo '<option value="'. get_book_author($id) .'">';
                            }
                            foreach (get_all_categoryids() as $categoryid) {
                                echo '<option value="'. $categoryid .'">'. get_categroy_name($categoryid) .'</option>';
                            }
                            ?>
                        </datalist>

                        <input type ="text" id="searchinput" placeholder="Search" list="searchlist">
                    </div>
                    </form>
                </div>
            
                <div class ="categorylist">
                    <form id="categoryForm">

                        <?php
                        function display_categories(){
                            foreach (get_all_categoryids() as $categoryid) {
                                echo '<button type="submit" class="cat-item-button" value="'. $categoryid .'">'. get_categroy_name($categoryid) .'</button>';
                            }
                        }

                        display_categories();
                        ?>

                    </form>
                </div>
            </div>
                    
            <div class ="books">

                <?php

                $lookup = $_GET['lookup'] ?? null;
                $categoryid = $_GET['category'] ?? null;

                function display_books($book_id_array){

                    if (empty($book_id_array)){
                        echo '<h1 style="color:'. SECONDARY_COLOR .'; padding-left: 10px;">No books found : (</h1>';
                    }

                    foreach ($book_id_array as $bookid) {
                        echo '<a href="'.get_book_url($bookid).'">';
                        echo '<div class ="book-holder">';
                        echo '<img class="front-image" src="'. get_book_image($bookid) .'" width="100px" height="100px">';
                        echo '<div class="title">'. get_book_title($bookid) .'</div>';
                        echo '</div>';
                        echo '</a>';
                    }
                }

                //if lookup is null
                if ($lookup == null){

                    if ($categoryid == null){

                        display_books(get_array_of_bookids());

                    } else {

                        display_books(get_array_of_bookids_in_category($categoryid));

                    }

                } else {

                    display_books(books_sql_like_search($lookup));

                }


                ?>

                <script>

                    var searchInput = document.getElementById('searchinput');


                    searchInput.addEventListener('change', function() {

                        var searchTerm = searchInput.value;

                        // Redirect to the books page with the search term as a query parameter
                        window.location.href = 'books.php?lookup=' + encodeURIComponent(searchTerm);
                    });

                    var categoryForm = document.getElementById('categoryForm');

                    categoryForm.addEventListener('submit', function(event) {
                        event.preventDefault();
                        var categoryid = event.submitter.value;
                        window.location.href = 'books.php?category=' + encodeURIComponent(categoryid);
                    });

                </script>


            </div>
        </div>

    </body>

</html>
