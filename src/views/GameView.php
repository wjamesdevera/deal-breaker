<?php

namespace DealBreaker\Views;

class GameView
{
    public static function renderFormForNonPair(int $playerCoins)
    {
?>
        <form action="play.php" method="post" class="form">
            <div class="">Bet:</div>
            <div class="d-flex gap-2">
                <div class="form-label d-flex align-items-center fs-5 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M9 14c0 1.657 2.686 3 6 3s6-1.343 6-3s-2.686-3-6-3s-6 1.343-6 3" />
                            <path d="M9 14v4c0 1.656 2.686 3 6 3s6-1.344 6-3v-4M3 6c0 1.072 1.144 2.062 3 2.598s4.144.536 6 0c1.856-.536 3-1.526 3-2.598c0-1.072-1.144-2.062-3-2.598s-4.144-.536-6 0C4.144 3.938 3 4.928 3 6" />
                            <path d="M3 6v10c0 .888.772 1.45 2 2" />
                            <path d="M3 11c0 .888.772 1.45 2 2" />
                        </g>
                    </svg>
                    <span id="betRange">
                        <?= number_format(floor($playerCoins * .1)) ?>
                    </span>
                </div>
                <input class="form-range" id="choiceRange" type="range" name="bet" min="<?= (floor($playerCoins * .1)) ?>" max="<?= $playerCoins ?>" value="<?= floor(($playerCoins * .1)) ?>" step="<?= floor(($playerCoins * .1)) ?>">
            </div>
            <div class="">
                <button name="choice" class="btn btn-primary toast-btn" style="background-color: #F6B17A;" value="deal">Deal</button>
                <button name="choice" class="btn btn-primary" value="no_deal">No Deal</button>
            </div>
        </form>
    <?php
    }
    public static function renderFormForPair(int $playerCoins)
    {
    ?>
        <form action="play.php" method="post" class="form flex-fill">
            <div class="">Bet:</div>
            <div class="d-flex gap-2">
                <div class="form-label d-flex align-items-center fs-5 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M9 14c0 1.657 2.686 3 6 3s6-1.343 6-3s-2.686-3-6-3s-6 1.343-6 3" />
                            <path d="M9 14v4c0 1.656 2.686 3 6 3s6-1.344 6-3v-4M3 6c0 1.072 1.144 2.062 3 2.598s4.144.536 6 0c1.856-.536 3-1.526 3-2.598c0-1.072-1.144-2.062-3-2.598s-4.144-.536-6 0C4.144 3.938 3 4.928 3 6" />
                            <path d="M3 6v10c0 .888.772 1.45 2 2" />
                            <path d="M3 11c0 .888.772 1.45 2 2" />
                        </g>
                    </svg>
                    <span id="betRange">
                        <?= number_format(floor($playerCoins * .1)) ?>
                    </span>
                </div>
                <input class="form-range" id="choiceRange" type="range" name="bet" min="<?= (floor($playerCoins * .1)) ?>" max="<?= $playerCoins ?>" value="<?= floor(($playerCoins * .1)) ?>" step="<?= floor(($playerCoins * .1)) ?>">
            </div>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pair_choice" id="high" value="high" checked />
                    <label class="form-check-label" for="high"> Higher </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pair_choice" id="low" value="low" />
                    <label class="form-check-label" for="low"> Lower </label>
                </div>
            </div>
            <button name="choice" class="btn btn-primary" style="background-color: #F6B17A;" value="deal">Deal</button>
            <button name="choice" class="btn btn-primary" value="no_deal">No Deal</button>
        </form>
    <?php
    }

    public static function renderWin()
    {
    ?>
        <div class="you-won-message fs-2 mx-auto flex-fill puff-in-center">
            YOU WON!
        </div>;
<?php
    }

    public static function renderLose()
    {
        echo '<div class="you-won-message fs-2 mx-auto flex-fill puff-in-center">
                YOU LOSE!
                </div>';
    }
}
