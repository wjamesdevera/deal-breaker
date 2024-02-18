<?php
use DealBreaker\Game;

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

$game = new Game();

$game->printWelcome();

?>
