<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../sql/copies.php';
require_once __DIR__ . '/../sql/old_records.php';
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/old_reservation.php';

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

    return true;
}

function get_reason_why_user_cant_checkout_copy($uuid, $copyid): string
{
    //check if copy exists
    if (!is_copyid_exists($copyid)){
        return "Copy does not exist.";
    }

    //check if user exists
    if (!is_uuid_exists($uuid)){
        return "User does not exist.";
    }

    //check if copy alredy checked out
    if (is_copy_alredy_checked_out($copyid)){
        return "Copy is already checked out.";
    }

    //checks user exceeds checkout limit
    if (has_user_exceeded_checkout_limit($uuid)){
        return "User has exceeded checkout limit.";
    }

    return "User can checkout the copy.";
}

function get_return_date_of_copy($copyid): string
{
    $latest_recordid = get_latest_valid_recordID_of_copy($copyid);
    $start_date = get_record_start($latest_recordid);
    $return_date = date('Y-m-d', strtotime($start_date . ' + ' . MAX_CHECKOUT_DAYS . ' days'));
    return $return_date;
}


//private functions
function has_user_exceeded_checkout_limit($uuid): bool
{
    $active_checkouts = get_amount_of_active_checkouts($uuid);
    return $active_checkouts >= MAX_CHECKOUTS;
}

function get_amount_of_active_checkouts($uuid): int
{
    $active_checkouts = 0;
    $active_checkouts_array = get_recordids_of_active_checkouts($uuid);
    $active_checkouts = count($active_checkouts_array);
    return $active_checkouts;
}

function is_copy_alredy_checked_out($copyid): bool
{
    $latest_recordid = get_latest_valid_recordID_of_copy($copyid);
    $latest_record_type = get_record_type($latest_recordid);
    return $latest_record_type == "checkout";
}
