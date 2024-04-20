<?php


//Warning: Trash Code Ahead
//simple and inefficient php scheduler designed and developed by Kasun Hapangama
//Warning: This is not a secure way to schedule tasks, use a proper scheduler like cron jobs for production use


require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../sql/schedules.php';
require_once __DIR__ . '/../schedules/reservations.php';
check();

//this function will be called by books.php every time someone visits the site
function check() : void
{
    check_reservations_schedules();
}

function check_reservations_schedules() : void
{
    $reservation_schedule_delay_secounds = RESERVATION_CHECK_INTERVAL_SECONDS;

    if (check_if_id_exists("reservations")) {
        $time = get_schedule_time("reservations");
        if (time() - $time >= $reservation_schedule_delay_secounds) {
            set_schedule_time("reservations");
            invalidate_all_books_invalidable_reservations();
        }
    } else {
        create_schedule("reservations");
        invalidate_all_books_invalidable_reservations();
    }
}

