<?php

require_once __DIR__ . '/../sql/users.php';

session_start();

$uuid = $_SESSION["uuid"] ?? null;

if (is_null($uuid)){
    header("Location: /login.php");
}

