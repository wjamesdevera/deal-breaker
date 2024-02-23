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

include_once './includes/header.php';
?>
  <?php
  if ($_SESSION['round_num'] != 10) :
    require_once './includes/game.php';
  ?>
  <?php else :
    header('location: index.php');
    die();
  endif ?>
<?php require_once './includes/footer.php' ?>