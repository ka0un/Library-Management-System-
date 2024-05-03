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
            overflow: scroll;
        }

        .copyrow{
            display: flex;
            flex-direction: row;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .main{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
        }

        .sides{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: flex-start;
            padding: 20px;
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

        echo '<div class="main">';

        //image side
        echo '<div class="sides">';
        echo '<h1>Edit Image</h1>';
        echo '<img src="'. get_book_image($bookid) .'" alt="Book Image" width="200" height="300">';

        //edit image form
        echo '<div class="edit">';
        echo '<form action="" method="post" enctype="multipart/form-data">';
        echo '<input type="file" id="addbook_buttons" class="add_book_submit" value="Submit" name="image">';
        echo '<br><br>';
        echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Submit" name="editimage">';
        echo '</form>';

        //handle image edit
        // not done yet

        echo '</div>';
        echo '</div>';

        echo '<div class="sides">';

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
            echo '<script>window.location = "updatebook.php?bookid=' . $bookid . '"</script>';


        }

        //delete book form
        echo '<div class="edit">';
        echo '<h1>Delete Book</h1>';
        echo '<form action="" method="post">';
        echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Delete" name="delete">';
        echo '</form>';
        echo '</div>';

        //handle delete book
        if (isset($_POST['delete'])) {
            //ask user for confirmation and notify them its going to deleted x amount of copies
            $copies = get_array_of_copyids($bookid);
            echo '<script>alert("Are you sure you want to delete this book? This will also delete '. count($copies) .' copies")</script>';

            //delete copies
            foreach ($copies as $copyid) {
                remove_copy($copyid);
            }

            //delete book
            remove_book($bookid);
            echo '<script>window.location = "updatebook.php"</script>';
        }

        echo '</div>';
        echo '<div class="sides">';

        //add copy form
        echo '<div class="edit">';
        echo '<h1>Add Copies</h1>';
        echo '<form action="" method="post">';
        echo '<input type="number" id="textbox" class="textbox" placeholder="Number Of Copies" min="1" required name="number"><br><br>';
        echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Add" name="addcopy">';
        echo '</form>';
        echo '</div>';

        //handle add copy
        if (isset($_POST['addcopy'])) {
            $number = $_POST['number'];
            for ($i = 0; $i < $number; $i++) {
                $copyid = generate_copyID();
                $status = 0;
                $condition = "Good";
                $pr = 0;
                add_copy($copyid, $bookid, $status, $pr, $condition);
            }
            //reload page
            echo '<script>window.location = "updatebook.php?bookid=' . $bookid . '"</script>';
        }

        //copy editing table
        echo '<div class="edit">';
        echo '<h1>Edit Copies</h1>';
        foreach (get_array_of_copyids($bookid) as $copyid) {
            echo '<form action="" method="post">';
            echo '<div class="copyrow">';
            echo '<input type="text" id="" class="textbox" placeholder="Enter Copy ID" required name="copyid" value="'. $copyid .'" readonly><br><br>';
            echo '<input type="text" id="textbox" class="textbox" placeholder="Enter Condition" required name="condition" value="'. get_copy_pcondition($copyid) .'"><br><br>';
            //copy permemently reserved checkbox
            if (is_copy_pr($copyid) == 1) {
                echo '<input type="checkbox" id="textbox" class="textbox" placeholder="Enter Condition" name="pr" value="0" checked>PR<br><br>';
            }else{
                echo '<input type="checkbox" id="textbox" class="textbox" placeholder="Enter Condition" name="pr" value="1">PR<br><br>';

            }
            echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Edit" name="editcopy">';
            //delete button
            echo '<input type="submit" id="addbook_buttons" class="add_book_submit" value="Delete" name="deletecopy">';
            echo '</div>';
            echo '</form>';

        }


        echo '</div>';

        //handle copy editing
        if (isset($_POST['editcopy'])) {
            $copyid = $_POST['copyid'];
            $status = 0;
            $condition = $_POST['condition'];
            $pr = $_POST['pr'];

            update_copy($copyid, $bookid, $status, $pr, $condition);

            echo '<script>window.location = "updatebook.php?bookid=' . $bookid . '"</script>';
        }

        //handle delete button
        if (isset($_POST['deletecopy'])) {
            $copyid = $_POST['copyid'];
            remove_copy($copyid);

            echo '<script>window.location = "updatebook.php?bookid=' . $bookid . '"</script>';
        }

        echo '</div>';
        echo '</div>';




    }


    ?>
</div>

