<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../sql/categories.php';
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';

if (!has_permission($_SESSION['uuid'], 'UPDATE_BOOK')) {
    header("Location: /index.php");
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="style/book.php">

    </head>


    <style>
        .panel{
            background-color: <?php echo TERTIARY_COLOR; ?>;
            color: <?php echo PRIMARY_COLOR; ?>;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            margin-left: 10px;
            border-radius: 10px;
            height: 85%;
            font-family:Verdana, sans-serif;
            font-weight: bold;
            font-size: 14px;
        }
    </style>

<body bgcolor="<?php echo SECONDARY_COLOR;?>">
<?php

generate_header(array());

?>

<?php
include( __DIR__ . '/../components/sidebar.php');
?>
<div class="panel">

    <?php
    if (!isset($_GET['bookid'])) {
        echo '<div class="enter_id">';
        echo '<h1>Enter Book ID</h1>';
        echo '<form action="" method="post">';
        echo '<datalist id = "data">';
        foreach (get_array_of_bookids() as $bookid) {
            echo '<option value="'. $bookid .'">';
        }
        echo '</datalist>';
        echo '<input type ="text" id="searchinput" placeholder="Category" list="data" class="textbox" required name="category">';
        echo '<br><br>';
        echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Submit" name="id">';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['id'])) {
            $bookid = $_POST['category'];
            if (!is_bookid_exists($bookid)) {
                echo '<script>alert("Book not found")</script>';
            } else {
                echo '<script>window.location = "updatebook.php?bookid=' . $bookid . '"</script>';
            }

        }
    }else{
        $bookid = $_GET['bookid'];
        echo '<div class="edit">';
        echo '<h1>Edit Book Details</h1>';
        echo '<form action="" method="post">';
        echo '<input type="text" id="" class="textbox" placeholder="Enter Title" required name="title" value="'. get_book_title($bookid) .'"><br><br>';
        echo '<input type="text" id="textbox" class="textbox" placeholder="Enter Author" required name="author" value="'. get_book_author($bookid) .'"><br><br>';
        echo '<input type="text" id="textbox" class="textbox" placeholder="Enter ISBN" required name="isbn" value="'. get_book_isbn($bookid) .'"><br><br>';
        echo '<datalist id = "data">';
        foreach (get_all_categoryids() as $categoryid) {
            echo '<option value="'. get_categroy_name($categoryid) .'">';
        }
        echo '</datalist>';
        echo '<input type ="text" id="searchinput" placeholder="Category" list="data" class="textbox" required name="category" value="'. get_categroy_name(get_book_category_id($bookid)) .'">';
        echo '<br><br>';
        echo '<textarea cols=23 rows=5 id="textarea_addbook" class="textarea_addbook" name="description">'. get_book_description($bookid) .'</textarea><br>';
        echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Submit" name="edit">';
        echo '</form>';
        echo '</div>';

        if (isset($_POST['edit'])) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $isbn = $_POST['isbn'];
            $description = $_POST['description'];

            //checks if category exists if yes use that id
            $categoryid = null;
            $category_exisits = false;
            foreach (get_all_categoryids() as $cid) {
                if (get_categroy_name($cid) == $_POST['category']) {
                    $categoryid = $cid;
                    $category_exisits = true;
                    break;
                }
            }

            //if category does not exist add category and get the id
            if (!$category_exisits) {
                add_category($_POST['category']);
                foreach (get_all_categoryids() as $cid) {
                    if (get_categroy_name($cid) == $_POST['category']) {
                        $categoryid = $cid;
                        break;
                    }
                }
            }


            update_book($bookid, $title, $author, $isbn, get_book_reservations($bookid),$description, $categoryid);
            echo '<script>alert("Book updated successfully")</script>';
        }
    }


    ?>
</div>

