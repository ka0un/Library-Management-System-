<?php

require_once __DIR__ . '/../sql/users.php';
require_once __DIR__ . '/../sql/token.php';

session_start();

$uuid = $_SESSION["uuid"] ?? null;
$token = $_SESSION["token"] ?? null;


if (is_null($uuid) || is_null($token) || !validate_token($uuid, $token)){
    header("Location: /login.php");
}

