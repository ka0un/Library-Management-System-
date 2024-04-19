<?php
require_once __DIR__ . '/../sql/books.php';
require_once __DIR__ . '/../validators/reservation.php';
require_once __DIR__ . '/../sql/reservations.php';
require_once __DIR__ . '/../config.php';


function invalidate_all_books_invalidable_reservations(): void
{
    $bookids = get_array_of_bookids();

    if(count($bookids) <= 0){
        return;
    }

    foreach($bookids as $bookid){
        invalidate_book_invalidable_reservations($bookid);
    }
}


//function to invalidate book's invalidable reservations
function invalidate_book_invalidable_reservations($bookid): void
{
    $reservationids = get_reservation_ids_of_book($bookid);

    if(count($reservationids) <= 0){
        return;
    }

    foreach($reservationids as $reservationid){
        //if reservation time is exceeded, invalidate reservation
        if(is_reservation_time_exceeded($reservationid)){
            invalidate_reservation($reservationid);
        }
    }

}