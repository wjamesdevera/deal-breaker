<?php

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: index.php');
    die();
}

use DealBreaker\Model\User;
use DealBreaker\RandomUsernameGenerator;

$userObject = new User();
$randomUsernameGenerator = new RandomUsernameGenerator();


if (isset($_POST['username'])) {
    $username = sanitizeInput($_POST['username']);
    if (userExist($username)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetchUser($username);
        header('location: index.php');
        die();
    } else if (!empty($username)) {
        $userObject->addNewUser($username);
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetchUser($username);
        header('location: index.php');
        die();
    } else {
        $randomUser = $randomUsernameGenerator->generateRandomUsername();
        if (userExist($randomUser)) {
            $randomUser = $randomUsernameGenerator->generateRandomUsername();
        }
        $userObject->addNewUser($randomUser);
        $_SESSION['logged_in'] = true;
        $_SESSION['logged_user'] = $userObject->fetchUser($randomUser);
        header('location: index.php');
        die();
    }
}

function userExist(string $username): bool
{
    global $userObject;
    $users = $userObject->fetchUsers();
    foreach ($users as $user) {
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
