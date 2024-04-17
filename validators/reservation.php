<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/reservations.php';
require_once __DIR__ . '/../config.php';

function can_user_reserve_book($uuid, $bookid): bool
{
    //check if book exists
    if (!is_bookid_exists($bookid)){
        return false;
    }

    //check if user exists
    if (!is_uuid_exists($uuid)){
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
    //check if book exists
    if (!is_bookid_exists($bookid)) {
        return "Book does not exist.";
    }

    //check if user exists
    if (!is_uuid_exists($uuid)) {
        return "User does not exist.";
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