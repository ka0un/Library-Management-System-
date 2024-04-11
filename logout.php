<?php
require_once __DIR__ . '/sql/token.php';
session_start();

$uuid = $_SESSION["uuid"];
$token = $_SESSION["token"];

delete_token($uuid, $token);

session_destroy();
header("Location: /login.php");
