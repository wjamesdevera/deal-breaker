<?php

use DealBreaker\Views\GameView;

function sanitizeInput(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $_SESSION['round_num']++;
?>
    <div class="h-100 d-flex flex-column">
        <?php
        GameView::renderGameCardsResult($_SESSION['round_num'], $game->getDealtCards(), $game->getPlayerCard());
        if (isset($_POST['pair_choice'])) {
            if (isset($_POST['bet']) && isset($_POST['choice'])) {
                $result = $game->determineOutcome($_POST['pair_choice']);
                if ($result == 'win_pair' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + $_POST['bet']));
                    GameView::renderWin();
                } else if ($result == 'lose_match' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] - $_POST['bet']));
                    GameView::renderLose();
                }
            }
        } else {
            if (isset($_POST['bet']) && isset($_POST['choice']) && !isset($_POST['pair_choice'])) {
                $result = $game->determineOutcome();
                if ($result == 'win_jackpot' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + ($_POST['bet'] * 5)));
                    GameView::renderWin();
                } else if ($result == 'win_inbetween' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + $_POST['bet']));
                    GameView::renderWin();
                } else if ($result == 'lose_match' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] - $_POST['bet']));
                    GameView::renderLose();
                }
            }
        }
        ?>
        <form action="play.php" method="get">
            <button type="submit" class="btn btn-primary">PLAY AGAIN</button>
        </form>
    </div>
<?php else : ?>
    <?php
    $_SESSION['round_cards'] = $_SESSION['game']->dealTwoCards();
    $deal = $_SESSION['round_cards'];
    ?>
    <div class="d-flex flex-column h-100">
        <?php 
        GameView::renderGameCards($_SESSION['round_num'], $game->getDealtCards());
        if ($deal['pair']) {
            GameView::renderFormForPair($_SESSION['logged_user']['coins']); 
        } else {
            GameView::renderFormForNonPair($_SESSION['logged_user']['coins']); 
        }
        ?>
    </div>
<?php endif ?>
<?php
$_SESSION['logged_user'] = $user->fetchUser($_SESSION['logged_user']['username']);
if ($_SESSION['logged_user']['coins'] <= 0) {
    $user->deleteUser($_SESSION['logged_user']['user_id']);
    unset($_SESSION['logged_in']);
    unset($_SESSION['logged_user']);
    die();
}
?>
<script>
    const choiceRange = document.querySelector('#choiceRange');
    choiceRange.addEventListener('change', () => {
        console.log(choiceRange.value);
        document.querySelector('#betRange').innerHTML = numberWithCommas(choiceRange.value);
    })

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>