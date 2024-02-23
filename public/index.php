<?php
use DealBreaker\Game;
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deal Breaker</title>
</head>
<body>
    <?php if (!isset($_SESSION['logged_in'])): ?>
        <form action="handle_login.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="submit" value="Login">
        </form>
    <?php else: ?>
        <?= 'Welcome, ' . $_SESSION['logged_user']['username']?>
        <a href="play.php">Play</a>
        <form action="handle_logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    <?php endif ?>
</body>
</html>