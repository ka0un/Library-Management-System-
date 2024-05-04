<?php
//===================================================================
//██╗     ███╗   ███╗███████╗  Library Management System
//██║     ████╗ ████║██╔════╝  Version : 1.0 (2024)
//██║     ██╔████╔██║███████╗  Source : https://lms1.hapangama.com
//██║     ██║╚██╔╝██║╚════██║  License : MIT
//███████╗██║ ╚═╝ ██║███████║  Doc : https://docs-lms1.hapangama.com
//╚══════╝╚═╝     ╚═╝╚══════╝  Contact : kasun@hapangama.com
//===================================================================
//SQL Database configuration - Tested on MySQL and MariaDB
//===================================================================


const DB_HOST = "129.146.1.186"; /* Your Database Host (without port) */
const DB_PORT = 3306; /* Your Database Port (usually 3306) */
const DB_USERNAME = "u14_Rf6AAvsnO7"; /* Your Database Username */
const DB_PASSWORD = "5!csXM+5^fke.XNpM=fIfI99"; /* Your Database Password */
const DB_DATABASE = "s14_main"; /* Your Database Name */
const GENERATE_TABLES = true; /* Change this to false in a production env*/


//===================================================================
//Limits configuration
//===================================================================
const MAX_BOOK_RESERVATIONS = 1; /* Maximum number of books a user can reserve */
const MAX_RESERVATION_DAYS = 7; /* Maximum number of days a book can be reserved */
const MAX_RESERVATION_SECOUNDS = 60; /* Maximum number of days a book can be reserved */
const MAX_CHECKOUTS = 1; /* Maximum number of books a user can check out */
const MAX_CHECKOUT_DAYS = 14; /* Maximum number of days a book can be checked out */
const MAX_CHECKOUT_SECONDS = 60; /* Maximum number of days a book can be checked out */
const FINE_PER_DAY = 0.5; /* Fine per day for overdue books */
//===================================================================
//Schedules configuration
//===================================================================
const RESERVATION_CHECK_INTERVAL_SECONDS = 60; /* Reservation check interval in seconds */
const CHECKOUT_CHECK_INTERVAL_SECONDS = 60; /* Checkout check interval in seconds */
//===================================================================
//Design and Branding
//===================================================================
const PRIMARY_COLOR = "#292929";
const SECONDARY_COLOR = "#D9D9D9";
const TERTIARY_COLOR = "#5e5e5e";
const BRAND_NAME = "Library Management System";
const USE_API_TO_DEFAULT_PROFILE_PICTURE = true; /* Use API to get default profile picture */
const USE_API_TO_DEFAULT_BOOK_COVER = true; /* Use API to get default book cover */

//===================================================================
//Role and Permissions configuration
//===================================================================
const ROLES = array(
    1 => "Admin",
    2 => "Assistance",
    3 => "Member",
);
const DEFAULT_ROLE = 3; /* Default role for new users */
const PERMISSIONS = array(
    1 => array(
        "VIEW_ADMIN_DASHBOARD",
        "ALL",
    ),
    2 => array(
        "RESERVE_BOOK",
        "permission_4",
    ),
    3 => array(
        "RESERVE_BOOK",
        "permission_6",
    ),
);

const STAFF = array(
    1 => array(
        "U0000001",
    ),
    2 => array(

    ),
    3 => array(

    ),
);

//===================================================================
