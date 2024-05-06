<?php
require_once __DIR__ . '/Reportpage/report_table_data_entry.php';
session_start();

try{
    userlogout($_SESSION["uuid"]);
}catch (Exception $ignored){}

$uuid = $_SESSION["uuid"];


session_destroy();
header("Location: /login.php");
