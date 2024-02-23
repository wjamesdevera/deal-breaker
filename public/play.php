<?php

use DealBreaker\Game;
use DealBreaker\Model\User;

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";
session_start();

$user = new User();

if (!isset($_SESSION["logged_in"])) {
  header("location: index.php");
  die();
}

if (isset($_SESSION["game"])) {
  $game = $_SESSION['game'];
} else {
  $_SESSION['game'] = new Game();
  $game = $_SESSION['game'];
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Deal Breaker</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <audio loop autoplay>
    <source src="./media/bg.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
  <h4>Play</h4>
  <p>Coins:
    <?= $_SESSION['logged_user']['coins'] ?>
  </p>
  <p>
    Round:
    <?= $_SESSION['round_num'] + 1 ?>
  </p>
  <form action="handle_logout.php" method="post">
    <input type="submit" value="Logout">
  </form>
  <?php
  if ($_SESSION['round_num'] != 10) :
    include 'game.php';
    $users = $user->fetchUsers();
  ?>
  <table class="table">
    <thead>
      <tr>
        <th class="col">Username</th>
        <th class="col">Coin</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($users as $user):  ?>
        <tr>
          <td class="col"><?= $user['username'] ?></td>
          <td class="col"><?= $user['coins'] ?></td>
        </tr>
  <?php endforeach ?>
    </tbody>
  </table>
  <?php else :
    header('location: index.php');
    die();
  endif ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>