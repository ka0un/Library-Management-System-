<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/sql/books.php';
require_once __DIR__ . '/sql/copies.php';
require_once __DIR__ . '/sql/reservations.php';
require_once __DIR__ . '/validators/checkout.php';
require_once __DIR__ . '/validators/reservation.php';
require_once __DIR__ . '/sql/checkouts.php';
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
generate_header([
    ['url' => '/books.php', 'text' => 'Books'],
    ['url' => '#', 'text' => 'test']
]);

$bookid = 'B0000001';

?>
    <div class="book-container">
        <div class="book-image">
            <img src="images/images.jpg" alt="Book Cover">
        </div>
        <div class="book-info">
            <div class="book-details">
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
            </div>
            <div class="book-actions">
                <form action="" method="post">
                    <input type="hidden" name="bookid" value="<?php echo $bookid; ?>">

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

                        $checkout_id = get_checkout_id($_SESSION['uuid'], $checkouted_copyid);
                        $checkout_copy_id = get_checkout_copyid($checkout_id);

                        //get checkout start date
                        $checkout_start_date = get_checkout_start($checkout_id);

                        //get checkout start timestamp
                        $checkout_start_timestamp = strtotime($checkout_start_date);

                        //get amount of days left for checkout
                        $amount_of_chekout_days_left = ($checkout_start_timestamp + (MAX_CHECKOUT_DAYS * 24 * 60 * 60) - time()) / (24 * 60 * 60);

                        //if the amount of days left is less than 0, the user has exceeded the checkout limit
                        if ($amount_of_chekout_days_left < 0) {

                            $exceeded_amount_of_days = abs($amount_of_chekout_days_left);
                            $fine = $exceeded_amount_of_days * FINE_PER_DAY;
                            echo '<div class="description">
                            <span>You have exceeded max day limit!</span>
                            <span>Copy ID : '. $checkouted_copyid . '</span>
                            <span>Days Exceeded : '. $exceeded_amount_of_days . '</span>
                            <span>Fine : '. $fine . '</span>
                        </div>';


                        }else{

                            echo '<div class="description">
                        <span>You have already checked out a copy of this book!</span>
                        <span>Copy ID : '. $checkouted_copyid . '</span>
                        <span>Checkout Start Date : '. $checkout_start_date . '</span>
                        <span>Days Left : '. $amount_of_chekout_days_left . '</span>
                    </div>
                        
                        ';
                        }


                    } else {

                                //check if user has already reserved the book
                                if (is_user_reserved_book($_SESSION['uuid'], $bookid)) {

                                    $reservation_id = get_reservation_id($bookid, $_SESSION['uuid']);
                                    $reservation_start = get_reservation_start($reservation_id);
                                    $reservation_start_timestamp = strtotime($reservation_start);
                                    $time_left_string = $reservation_start_timestamp + (MAX_RESERVATION_DAYS * 24 * 60 * 60) - time();
                                    // Convert the time left (in seconds) to a DateInterval object
                                    $time_left_interval = DateInterval::createFromDateString($time_left_string . ' seconds');

                                    // Format the DateInterval object into a string that represents the time left in days and hours
                                    $time_left_string = $time_left_interval->format('%a day(s) %h hour(s)');


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
                                        <div class="book-button">
                                        <input type="submit" id="button" value="Reserve" name="Reserve" class="login_submit">
                                        </div>
                                        ';
                                        }
                                    }
                                }
                    }
                }

                ?>
                </form>

                <?php
                if(isset($_POST['Reserve'])){

                    $bookid = $_POST['bookid'];
                    $uuid = $_SESSION['uuid'];

                    if(can_user_reserve_book($uuid, $bookid)){
                        add_reservation($bookid, $uuid);
                        //reload the page
                        header('Location: ' . $_SERVER['PHP_SELF']);
                        exit;

                    }else{


                    }

                }
                ?>


            </div>
        </div>
    </div>
</body>
</html>
