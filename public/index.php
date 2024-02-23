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
    <?php if (!isset($_SESSION['logged_in'])) : ?>
        <form action="handle_login.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username" autocomplete="off">
            <input type="submit" value="Login">
        </form>
    <?php else : ?>
        <?php
        $_SESSION['round_num'] = 0;
        ?>
        <?= 'Welcome, ' . $_SESSION['logged_user']['username'] ?>
        <br>
        <?= 'Coins ' .  $_SESSION['logged_user']['coins'] ?>
        <br>
        <a href="play.php">Play</a>
        <form action="handle_logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    <?php endif ?>
    <audio loop autoplay>
        <source src="./media/bg.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</body>

</html>