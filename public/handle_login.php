<?php

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: index.php');
    die();
}

use DealBreaker\Model\User;

$userObject = new User();

if (isset($_POST['username'])) {
    $username = sanitizeInput($_POST['username']);
    if (userExist($username)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetch_user($username);
        header('location: index.php');
        die();
    } else {
        header('location: index.php');
        die();
    }
}

function userExist(string $username): bool
{
    global $userObject;
    $users = $userObject->fetchUsers();
    foreach($users as $user) {
        if ($user['username'] == $username) {
            return true;
        }
    }
    return false;
}


function sanitizeInput(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
