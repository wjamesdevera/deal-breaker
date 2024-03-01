<?php

namespace DealBreaker\Views;

class GameView
{

    private static function renderWin()
    {
        echo '<div class="you-won-message fs-2 mx-auto flex-fill puff-in-center">
                YOU WON!
                </div>';
    }

    private static function renderLose()
    {
        echo '<div class="you-won-message fs-2 mx-auto flex-fill puff-in-center">
                YOU LOSE!
                </div>';
    }

}
