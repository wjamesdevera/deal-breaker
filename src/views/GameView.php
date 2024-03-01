<?php

namespace DealBreaker\Views;

class GameView
{

    private static function renderWin()
    {
        return '<div class="you-won-message fs-2 mx-auto flex-fill puff-in-center">
                YOU WON!
                </div>';
    }

    private static function renderLose()
    {
        return '<div class="you-won-message fs-2 mx-auto flex-fill puff-in-center">
                YOU LOSE!
                </div>';
    }
}
