<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/sql/books.php';
require_once __DIR__ . '/sql/copies.php';
require_once __DIR__ . '/sql/reservations.php';
require_once __DIR__ . '/validators/checkout.php';
require_once __DIR__ . '/validators/reservation.php';
require_once __DIR__ . '/sql/checkouts.php';
require_once __DIR__ . '/sql/categories.php';
require_once __DIR__ . '/schedules/sheduler.php';
require_once __DIR__ . '/Reportpage/report_table_data_entry.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Page</title>
    <link rel="stylesheet" href="style/book.php">
</head>
<body bgcolor="<?php echo SECONDARY_COLOR;?>">
<?php

// Function to get average rating
function get_average_rating($bookid) {
    global $conn;  // Use the database connection
    $avg_rating_query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE bookid = ?";
    $stmt = $conn->prepare($avg_rating_query);
    $stmt->bind_param("s", $bookid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $result->num_rows > 0 ? round($row['avg_rating'], 1) : "Not rated";
}

$average_rating = get_average_rating($_GET['id']);

$bookid = 'B0000001';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $bookid = $id;
}

$book_title = get_book_title($bookid);

generate_header([
    ['url' => '/books.php', 'text' => 'Books'],
    ['url' => '#', 'text' => $book_title]
]);


?>
    <div class="book-container">
        <div class="book-image">
            <img src="<?php echo get_book_image($bookid); ?>" alt="Book Cover">
        </div>
        <div class="book-info">
            <div class="book-details">
                <div class="book-category">
                    <span>Category:</span>
                    <span><?php echo get_categroy_name(get_book_category_id($bookid)); ?></span>
                </div>
                <div class="book-title">
                    <h1><?php echo get_book_title($bookid); ?></h1>
                </div>
                <div class="book-author">
                    <h2>Average Rating: <?php echo $average_rating; ?></h2>
                </div>
                <div class="book-author">
                    <span>By:</span>
                    <span><?php echo get_book_author($bookid); ?></span>
                </div>
                <div class="book-description">
                    <p><?php echo get_book_description($bookid); ?></p>
                </div>
            </div>
            <div class="book-actions">

                <?php
                // if the user is not logged in, show a message to login
                if(!isset($_SESSION['uuid'])) {

                    echo '<div class="description">
                    <span>Login to reserve this book!</span>
                </div>';

                }else {

                    //check if user has checkout one of the copies
                    $copyids = get_array_of_copyids($bookid);
                    $is_user_checked_out = false;
                    $checkouted_copyid = '';

                    foreach ($copyids as $copyid) {
                        if (is_user_checked_out_copy($_SESSION['uuid'], $copyid)) {
                            $is_user_checked_out = true;
                            $checkouted_copyid = $copyid;
                            break;
                        }
                    }

                    //if user has checked out one of the copies

                    if ($is_user_checked_out) {

                        $checkout_id = get_checkout_id($checkouted_copyid);
                        $checkout_copy_id = get_checkout_copyid($checkout_id);

                        //get checkout start date
                        $checkout_start_date = get_checkout_start($checkout_id);

                        //get checkout start timestamp
                        $checkout_start_timestamp = strtotime($checkout_start_date);


                        //if the amount of days left is less than 0, the user has exceeded the checkout limit
                        if (get_checkout_time_left_seconds($checkout_id) < 0) {
                            echo '<div class="description">
                            <span>You have exceeded checkout time limit!</span>
                            <span>Copy ID : '. $checkouted_copyid . '</span>
                            <span>Days Exceeded : '. get_checkout_exceeded_days($checkout_id) . '</span>
                            <span>Fine : '. get_checkout_fine($checkout_id) . '</span>
                        </div>';

                        }else{

                            echo '<div class="description">
                        <span>You have already checked out a copy of this book!</span>
                        <span>Copy ID : '. $checkouted_copyid . '</span>
                        <span>Checkout Start Date : '. $checkout_start_date . '</span>
                        <span>Time Left : '. get_checkout_time_left_string($checkout_id) . '</span>
                    </div>
                        
                        ';
                        }


                    } else {

                                //check if user has already reserved the book
                                if (is_user_reserved_book($_SESSION['uuid'], $bookid)) {
                                    $time_left_string = get_reservation_time_left_string(get_reservation_id($bookid, $_SESSION['uuid']));
                                    echo '<div class="description">
                                    <span>You have already reserved this book!</span>
                                    <span>Visit our library to borrow your copy of the book!</span>
                                    <span>Time Left : '. $time_left_string . '</span>
                                    </div>
                                    ';
                                } else {

                                    if (has_user_exceeded_reservation_limit($_SESSION['uuid'])) {
                                        echo '<div class="description">
                                        <span>You have exceeded the reservation limit!</span>
                                        </div>
                                    ';
                                    }else {
                                        //check if book has available copies for current reservation
                                        $total_amount_of_copies = get_amount_of_copies($bookid);
                                        $pr_amount_of_copies = get_amount_of_pr_copies($bookid);
                                        $non_pr_amount_of_copies = $total_amount_of_copies - $pr_amount_of_copies;
                                        $reservations = get_amount_of_reservations_of_book($bookid);

                                        if ($non_pr_amount_of_copies <= $reservations) {
                                            echo '<div class="description">
                                        <span>There are no available copies for reservation!</span>';
                                        } else {
                                            echo '<div class="description">
                                        <span>This book is available for reservations!</span>
                                        <form action="" method="post" id="res">
                                        <div class="book-button">
                                        <input type="submit" id="button" value="Reserve" name="Reserve" class="login_submit">
                                        </div>
                                        </form>
                                        ';
                                        }
                                    }
                                }
                    }
                }

                ?>


                <?php
                if(isset($_POST['Reserve'])){

                    $bookid = $_GET['id'];
                    $uuid = $_SESSION['uuid'];

                    if(can_user_reserve_book($uuid, $bookid)){
                        add_reservation($bookid, $uuid);

                        try{
                            add_reservation_report($bookid, $uuid);
                        }catch (Exception $ignored) {}

                        //Send to the dashboard
                        header('Location: /dashboard.php');
                        exit;

                    }else{

                        echo get_reason_why_user_cannot_reserve_book($uuid, $bookid);

                    }

                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>
