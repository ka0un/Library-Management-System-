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

//===================================================================
//Session configuration
//===================================================================
const SESSION_LIFETIME_SECONDS = 3600; /* 1 hour = 3600 seconds, 1 day = 86400 seconds */

//===================================================================
//Role and Permissions configuration
//===================================================================
const ROLES = array(
    1 => "Admin",
    2 => "Assistance",
    3 => "User",
);
const DEFAULT_ROLE = 3; /* Default role for new users */
const PERMISSIONS = array(
    1 => array(
        "VIEW_ADMIN_DASHBOARD",
        "permission_2",
    ),
    2 => array(
        "permission_3",
        "permission_4",
    ),
    3 => array(
        "permission_5",
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
?>
