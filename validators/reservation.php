<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/records.php';
require_once __DIR__ . '/../config.php';

function is_book_available_for_reservation($bookid): bool
{
    //checks if book exists
    if (!is_bookid_exists($bookid)){
        return false;
    }

    $total_copies = get_amount_of_copies($bookid);

    //check if physical copies exists
    if ($total_copies == 0){
        return false;
    }

    $copies = get_array_of_copyids($bookid);

    // find amount of non pr copies
    $non_pr_copies = 0;

    foreach ($copies as $copyid){
        if (!is_copy_pr($copyid)){
            $non_pr_copies++;
        }
    }

    $current_reservations = 0;

    //finding current active reservations
    foreach ($copies as $copyid){

        $latest_recordid = get_latest_valid_recordID_of_copy($copyid);
        $latest_record_type = get_record_type($latest_recordid);

        if ($latest_record_type == "reservation"){
            $current_reservations++;
        }
    }

    if ($non_pr_copies - $current_reservations > 0){
        return true;
    }

    return false;

}

function can_user_reserve_a_book($uuid){

    //get all active reservations of user
    $active_reservations_array = get_recordids_of_active_reservations($uuid);

    //get length of active reservations array
    $active_reservations = count($active_reservations_array);

    if ($active_reservations < MAX_BOOK_RESERVATIONS){
        return true;
    }

    return false;

}


function get_reason_why_book_cannot_be_reserved($bookid, $uuid){

    if (!is_bookid_exists($bookid)){
        return "Book does not exist";
    }

    if (!can_user_reserve_a_book($uuid)){
        return "User has reached the maximum amount of reservations";
    }

    if (!is_book_available_for_reservation($bookid)){
        return "Book is not available for reservation";
    }

    return "Unknown error";

}


function is_user_reserved_book($uuid, $bookid): bool
{
    $records_of_user = get_recordids_of_active_reservations($uuid);

    foreach ($records_of_user as $recordid) {
        $record_copyid = get_record_copyid($recordid);
        $record_bookid = get_copy_bookid($record_copyid);
        if ($record_bookid == $bookid) {
            return true;
        }
    }

    return false;
}
