<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/records.php';
require_once __DIR__ . '/../config.php';

function is_book_available_for_reservation($bookid): bool
{
    //checks if physical copys exists
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

    foreach ($copies as $copyid){


        if (get_latest_valid_recordID_of_copy($copyid) != null){
            $current_reservations++;
        }
    }



}