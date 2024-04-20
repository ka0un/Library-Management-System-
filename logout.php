<?php
require_once __DIR__ . '/sql/token.php';
session_start();

$uuid = $_SESSION["uuid"];

session_destroy();
header("Location: /login.php");
