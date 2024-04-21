<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/reservations.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../auth/permission.php';

function can_user_reserve_book($uuid, $bookid): bool
{

    if (!has_permission($uuid, 'RESERVE_BOOK')){
        return false;
    }

    //check if user already reserved the book
    if (is_user_reserved_book($uuid, $bookid)){
        return false;
    }

    //check if user exceeds reservation limit
    if (has_user_exceeded_reservation_limit($uuid)){
        return false;
    }

    //check if book has available copies for reservation
    $total_amount_of_copies = get_amount_of_copies($bookid);
    $pr_amount_of_copies = get_amount_of_pr_copies($bookid);
    $non_pr_amount_of_copies = $total_amount_of_copies - $pr_amount_of_copies;
    $reservations = get_amount_of_reservations_of_book($bookid);

    if ($non_pr_amount_of_copies <= $reservations){
        return false;
    }

    return true;
}

function get_reason_why_user_cannot_reserve_book($uuid, $bookid): string
{

    if (!has_permission($uuid, 'RESERVE_BOOK')) {
        return "User does not have permission to reserve books. - RESERVE_BOOK";
    }

    //check if user exceeds reservation limit
    if (has_user_exceeded_reservation_limit($uuid)) {
        return "User has exceeded reservation limit.";
    }

    //check if book has available copies for reservation
    $total_amount_of_copies = get_amount_of_copies($bookid);
    $pr_amount_of_copies = get_amount_of_pr_copies($bookid);
    $non_pr_amount_of_copies = $total_amount_of_copies - $pr_amount_of_copies;
    $reservations = get_amount_of_reservations_of_book($bookid);

    if ($non_pr_amount_of_copies <= $reservations) {
        return "No available copies for reservation.";
    }

    return "Unknown error.";
}



//private functions
function has_user_exceeded_reservation_limit($uuid): bool
{
    $reservations = get_amount_of_reservations_of_user($uuid);
    return $reservations >= MAX_BOOK_RESERVATIONS;
}

function is_reservation_time_exceeded($reservationid): bool
{

    $start = get_reservation_start($reservationid);
    $start = strtotime($start);
    $current = time();
    $difference = $current - $start;

    if ($difference > MAX_RESERVATION_SECOUNDS){
        return true;
    }

    return false;

}

function get_reservation_time_left_string($reservationid): string
{
    $start = get_reservation_start($reservationid);
    $start = strtotime($start);
    $current = time();
    $difference = $current - $start;
    $time_left = MAX_RESERVATION_SECOUNDS - $difference;
    $time_left_string = gmdate("H:i:s", $time_left);
    return $time_left_string;
}
