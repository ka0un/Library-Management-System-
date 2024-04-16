<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/reservation.php';

function can_user_checkout_copy($uuid, $copyid): bool
{
    //check if copy exists
    if (!is_copyid_exists($copyid)){
        return false;
    }

    //check if user exists
    if (!is_uuid_exists($uuid)){
        return false;
    }

    //check if copy alredy checked out
    if (is_copy_alredy_checked_out($copyid)){
        return false;
    }

    //check if copy is pr
    if (is_copy_pr($copyid)){
        return false;
    }

    //checks user exceeds checkout limit
    if (has_user_exceeded_checkout_limit($uuid)){
        return false;
    }

    //get book id from copy
    $bookid = get_copy_bookid($copyid);

    //if user already reserved the book
    if (is_user_reserved_book($uuid, $bookid)){
        return true;
    }

    //check if book has available copies for current reservation
    $total_amount_of_copies = get_amount_of_copies($bookid);
    $pr_amount_of_copies = get_amount_of_pr_copies($bookid);
    $non_pr_amount_of_copies = $total_amount_of_copies - $pr_amount_of_copies;
    $reservations = get_amount_of_reservations_of_book($bookid);

    if ($non_pr_amount_of_copies <= $reservations){
        return false;
    }

    return true;
}

function get_reason_why_user_cannot_checkout_copy($uuid, $copyid): string
{
    //check if copy exists
    if (!is_copyid_exists($copyid)) {
        return "Copy does not exist.";
    }

    //check if user exists
    if (!is_uuid_exists($uuid)) {
        return "User does not exist.";
    }

    //check if copy alredy checked out
    if (is_copy_alredy_checked_out($copyid)) {
        return "Copy is already checked out.";
    }

    //check if copy is pr
    if (is_copy_pr($copyid)) {
        return "Copy is a PR copy.";
    }

    //checks user exceeds checkout limit
    if (has_user_exceeded_checkout_limit($uuid)) {
        return "User has exceeded checkout limit.";
    }

    //get book id from copy
    $bookid = get_copy_bookid($copyid);

    //check if book has available copies for current reservation
    $total_amount_of_copies = get_amount_of_copies($bookid);
    $pr_amount_of_copies = get_amount_of_pr_copies($bookid);
    $non_pr_amount_of_copies = $total_amount_of_copies - $pr_amount_of_copies;
    $reservations = get_amount_of_reservations_of_book($bookid);

    if ($non_pr_amount_of_copies <= $reservations) {
        return "All copies of the book are reserved.";
    }

    return "User can checkout copy.";

}

//private functions
function has_user_exceeded_checkout_limit($uuid): bool
{
    $checkouts = get_amount_of_checkouts_of_user($uuid);
    return $checkouts >= MAX_CHECKOUTS;
}