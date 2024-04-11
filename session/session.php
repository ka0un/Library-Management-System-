<?php

require_once __DIR__ . '/../sql/users.php';
require_once __DIR__ . '/../sql/token.php';

session_start();

$uuid = $_SESSION["uuid"];
$token = $_SESSION["token"];

if (!validate_token($uuid, $token)){
    header("Location: /login.php");
}

