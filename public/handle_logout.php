<?php

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: index.php');
    die();
}

if (!isset($_SESSION['logged_in']) || !isset($_SESSION['logged_user'])) {
    header('location: index.php');
    die();
}

$_SESSION['logged_in'] = false;
$_SESSION['logged_user'] = true;
unset($_SESSION['logged_in']);
unset($_SESSION['logged_user']);
session_destroy();
header('location: index.php');
die();
