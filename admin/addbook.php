<?php

include(__DIR__ . '/../auth/session.php');
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../sql/categories.php';
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';

if (!has_permission($_SESSION['uuid'], 'ADD_BOOK')) {
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
    <div class="add_book_1st_div">
        <h1>Add Book</h1>
        <form action="" method="post">
            <input type="text" id="" class="textbox" placeholder="Enter Title" required name="title"><br><br>
            <input type="text" id="textbox" class="textbox" placeholder="Enter Author" required name="author"><br><br>
            <input type="text" id="textbox" class="textbox" placeholder="Enter ISBN" required name="isbn"><br><br>
            <datalist id = "data">
                <?php
                foreach (get_all_categoryids() as $categoryid) {
                    echo '<option value="'. get_categroy_name($categoryid) .'">';
                }
                ?>
            </datalist>
            <input type ="text" id="searchinput" placeholder="Category" list="data" class="textbox" required name="category">
            <br><br>
            <textarea cols=23 rows=5 id="textarea_addbook" class="textarea_addbook" name="description">Discription</textarea><br>
            <input type="number" id="textbox" class="no_of_copies" placeholder="Number Of Copies" min="1" required name="number"><br><br>
<!--            <button class="upload_image_button" id="addbook_buttons"><img width="20" height="17" src="https://img.icons8.com/windows/32/1A1A1A/upload.png" alt="upload"/> Upload image</button><br><br>-->
            <input type="submit" id="addbook_buttons" class="add_book_submit" value="Submit" name="submit">
        </form>
    </div>
</div>

<?php
// handle form submission
if (isset($_POST['submit'])) {
    require_once __DIR__ . '/../sql/books.php';
    require_once __DIR__ . '/../sql/copies.php';

    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $number = $_POST['number'];

    $bookid = generate_bookID();

    //checks if category exists if yes use that id
    $categoryid = null;
    $category_exisits = false;
    foreach (get_all_categoryids() as $cid) {
        if (get_categroy_name($cid) == $category) {
            $categoryid = $cid;
            $category_exisits = true;
            break;
        }
    }

    //if category does not exist add category and get the id
    if (!$category_exisits) {
        add_category($category);
        foreach (get_all_categoryids() as $cid) {
            if (get_categroy_name($cid) == $category) {
                $categoryid = $cid;
                break;
            }
        }
    }

    add_book($bookid, $title, $author, $isbn,0, $description, $categoryid);

    for ($i = 0; $i < $number; $i++) {
        add_copy(generate_copyID(), $bookid, 0, 0, "good");
    }

    header("Location: /admin/index.php");
}
?>

</body>
</html>