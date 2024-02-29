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

if (!isset($_SESSION['background-img'])) {
  $_SESSION['background-img'] = random_int(1, 11) . ".jpg";
}

include_once './includes/header.php';
?>
<main class="d-flex justify-content-center align-items-center flex-fill">
  <?php
  if ($_SESSION['round_num'] != 10) :
    require_once './includes/game.php';
  ?>
  <?php else :
    unset($_SESSION['background-img']);
    header('location: index.php');
    die();
  endif ?>
</main>
<style>
  main {
    background-image: 
    url('./img/bg/<?= $_SESSION['background-img'] ?>');
    background-color: rgba(0, 0, 0, 0.50);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    background-blend-mode:color-burn;
  }
</style>
<?php require_once './includes/footer.php' ?>