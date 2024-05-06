<?php
require_once __DIR__ . '/Reportpage/report_table_data_entry.php';
session_start();

userlogout($_SESSION["uuid"]);
$uuid = $_SESSION["uuid"];


session_destroy();
header("Location: /login.php");
