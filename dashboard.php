<?php
require_once __DIR__ . '/components/header.php';
require_once __DIR__ . '/sql/users.php';
require_once __DIR__ . '/auth/permission.php';
require_once __DIR__ . '/sql/reservations.php';
require_once __DIR__ . '/sql/checkouts.php';
require_once __DIR__ . '/sql/books.php';
include(__DIR__ . '/auth/session.php');
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/sql/copies.php';
require_once __DIR__ . '/validators/checkout.php';
require_once __DIR__ . '/schedules/sheduler.php';
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
        <link rel="stylesheet" href="style/dashboard.php" type="text/css">
        <title>Dashboard</title>
    </head>
    <body bgcolor="<?php echo SECONDARY_COLOR;?>">
<?php
generate_header(array());
?>
    <div class="container">
        <div class="sidebar">
            <div class="image">
                <img src ="<?php echo get_user_profile_picture_url($_SESSION['uuid'], 60) ?>" alt="user-profile-picture" width="200">
            </div>
            <div class="info">
                <div class="name">
                    <?php echo get_user_name($_SESSION['uuid']); ?>
                </div>
                <div class="email">
                    <?php echo get_user_email($_SESSION['uuid']); ?>
                </div>
                <div class="nic">
                    <?php echo get_user_nic($_SESSION['uuid']); ?>
                </div>
                <div class="role">
                    <?php echo get_role_name(get_role($_SESSION['uuid'])); ?>
                </div>

            </div>
            <div class="actions">
                <div class="action">
                        <div class="book-button">
                            <a href="/logout.php">
                            <input type="submit" id="button" value="Logout" name="logout" class="logout">
                            </a>
                        </div>
                </div>

            </div>
        </div>
        <div class="right">
            <div class="stats">
                <div class="stat">
                    <div class="stat-title">
                        Checkouts
                    </div>
                    <div class="stat-value">
                        <?php echo get_amount_of_checkouts_of_user($_SESSION["uuid"]) ?>
                    </div>
                </div>
                <div class="stat">
                    <div class="stat-title">
                        Reservations
                    </div>
                    <div class="stat-value">
                        <?php echo get_amount_of_reservations_of_user($_SESSION["uuid"]) ?>
                    </div>
                </div>
            </div>
                <div class="table">
                    <div class="table-title">
                        Reservations
                    </div>
                    <div class="row-head">
                        <div class="c1">
                            Book
                        </div>
                        <div class="c2">
                            Reserved Date Time
                        </div>
                        <div class="c3">
                            Reserved Duration
                        </div>
                        <div class="c4">
                            Reservation Time Left
                        </div>
                    </div>

                    <?php function generate_reservations($uuid)
                    {
                        $reservations = get_reservation_ids_of_user($uuid);

                        if (empty($reservations))
                        {
                            echo '<div class="row">
                            <div class="c1">    
                            No Active reservations
                            </div>
                            </div>';

                            return;
                        }

                        foreach($reservations as $reservationid)
                        {
                            echo '<div class="row">
                            <div class="c1">
                            '.get_book_title(get_reservation_book_id($reservationid)).'
                            </div>
                            <div class="c2">
                            '.get_reservation_start($reservationid).'
                            </div>
                            <div class="c3">
                            '.date("H:i:s", MAX_RESERVATION_SECOUNDS) .'
                            </div>
                            <div class="c4">
                            '.get_reservation_time_left_string($reservationid).'
                            </div>
                            </div>';
                        }
                    }

                    generate_reservations($_SESSION['uuid']);
                    ?>
                </div>

                    <div class="table">
                        <div class="table-title">
                            Checkouts
                        </div>
                        <div class="row-head">
                            <div class="c1">
                                Book
                            </div>
                            <div class="c2">
                                Checkout Date Time
                            </div>
                            <div class="c3">
                                Checkout Duration
                            </div>
                            <div class="c4">
                                Return Time Left
                            </div>
                        </div>
                        <?php function generate_checkouts($uuid)
                        {
                            $checkouts = get_checkoutids_of_user($uuid);

                            if (empty($checkouts))
                            {
                                echo '<div class="row">
                                <div class="c1">
                                No Active checkouts
                                </div></div>';

                                return;
                            }

                            foreach($checkouts as $checkoutid)
                            {
                                echo '<div class="row">
                                <div class="c1">
                                '.get_copy_bookid(get_checkout_copyid($checkoutid)).'
                                </div>
                                <div class="c2">
                                '.get_checkout_start($checkoutid).'
                                </div>
                                <div class="c3">
                                '.MAX_CHECKOUT_DAYS . ' days' .'
                                </div>
                                <div class="c4">
                                '.MAX_CHECKOUT_DAYS.'
                                </div>
                                </div>';
                            }
                        }

                        generate_checkouts($_SESSION['uuid']);
                        ?>
                    </div>

            </div>
        </div>
</div>
    </body>
    </html>

