<?php
function sanitizeInput(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    $_SESSION['round_num']++;
    if (isset($_POST['choice'])) {
        $choice = sanitizeInput($_POST['choice']);
    } else if (isset($_POST['pair_choice'])) {
        $choice = sanitizeInput($_POST['pair_choice']);
    }
?>
    <div class="">
        <h3 class="container-fluid text-center">ROUND: <?= $_SESSION['round_num'] ?> RESULTS</h3>
        <div class="d-flex mb-2 gap-2">
            <div class="card border-0 rounded bg-dark" style="width: 8rem">
                <img src=<?= './img/cards/' . $game->getDealtCards()[0] . '.png' ?> alt="" class="img-fldui">
            </div>
            <div class="card rounded border-0 bg-dark" style="width: 8rem">
                <img src=<?= './img/cards/' . $game->getDealtCards()[1] . '.png' ?> alt="" class="img-fluid">
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-3">
            <div class="card rounded border-0 bg-dark" style="width: 8rem">
                <img src=<?= './img/cards/' . $game->getPlayerCard() . '.png' ?> alt="" class="img-fluid">
            </div>
        </div>
        <?php if (isset($_POST['pair_choice'])) : ?>
            <?php
            if (isset($_POST['bet']) && isset($_POST['choice'])) {
                $result = $game->determineOutcome($_POST['pair_choice']);
                if ($result == 'win_pair' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + ($_POST['bet'] * 3)));
            ?>
                    <div class="you-won-message fs-2 mx-auto">
                        YOU WON!
                    </div>
                <?php
                } else if ($result == 'lose_match' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] - $_POST['bet']));
                ?>
                    <div class="you-won-message fs-2 mx-auto">
                        YOU LOSE!
                    </div>
            <?php
                }
            }
            ?>
            <?php else :
            if (isset($_POST['bet']) && isset($_POST['choice']) && !isset($_POST['pair_choice'])) {
                $result = $game->determineOutcome();
                if ($result == 'win_inbetween' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + ($_POST['bet'] * 2)));
            ?>
                    <div class="you-won-message fs-2 mx-auto">
                        YOU WON!
                    </div>
                <?php
                } else if ($result == 'lose_match' && $_POST['choice'] == 'deal') {
                    $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] - $_POST['bet']));
                ?>
                    <div class="you-won-message fs-2 mx-auto">
                        YOU LOSE!
                    </div>
            <?php
                }
            } else
            ?>
        <?php endif ?>
        <form action="play.php" method="get">
            <button type="submit" class="btn btn-primary">PLAY AGAIN</button>
        </form>
    </div>
<?php else : ?>
    <?php
    $_SESSION['round_cards'] = $_SESSION['game']->dealTwoCards();
    $deal = $_SESSION['round_cards'];
    ?>
    <div class="">
        <h3 class="container-fluid text-center">ROUND: <?= $_SESSION['round_num'] ?></h3>
        <div class="d-flex mb-2 gap-2">
            <div class="card border-0 rounded bg-dark" style="width: 8rem">
                <img src=<?= './img/cards/' . $game->getDealtCards()[0] . '.png' ?> alt="" class="img-fldui">
            </div>
            <div class="card rounded border-0 bg-dark" style="width: 8rem">
                <img src=<?= './img/cards/' . $game->getDealtCards()[1] . '.png' ?> alt="" class="img-fluid">
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-3">
            <div class="card rounded border-0 bg-dark" style="width: 8rem">
                <img src=<?= './img/cards/' . $game->getDealtCards()[1] . '.png' ?> alt="" class="img-fluid opacity-0">
            </div>
        </div>
        <?php if ($deal['pair']) : ?>
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
                            <?= number_format(floor($_SESSION['logged_user']['coins'] * .1)) ?>
                        </span>
                    </div>
                    <input class="form-range" id="choiceRange" type="range" name="bet" min="<?= (floor($_SESSION['logged_user']['coins'] * .1)) ?>" max="<?= $_SESSION['logged_user']['coins'] ?>" value="<?= floor(($_SESSION['logged_user']['coins'] * .1)) ?>" step="<?= floor(($_SESSION['logged_user']['coins'] * .1)) ?>" data-sizing="px">
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

                <button name="choice" class="btn btn-primary" value="deal">Deal</button>
                <button name="choice" class="btn btn-primary" value="no_deal">No Deal</button>
            </form>
        <?php else : ?>
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
                            <?= number_format(floor($_SESSION['logged_user']['coins'] * .1)) ?>
                        </span>
                    </div>
                    <input class="form-range" id="choiceRange" type="range" name="bet" min="<?= (floor($_SESSION['logged_user']['coins'] * .1)) ?>" max="<?= $_SESSION['logged_user']['coins'] ?>" value="<?= floor(($_SESSION['logged_user']['coins'] * .1)) ?>" step="<?= floor(($_SESSION['logged_user']['coins'] * .1)) ?>" data-sizing="px">
                </div>
                <div class="">
                    <button name="choice" class="btn btn-primary toast-btn" value="deal">Deal</button>
                    <button name="choice" class="btn btn-primary" value="no_deal">No Deal</button>
                </div>
            </form>
        <?php endif ?>
    </div>
<?php endif ?>
<?php

$_SESSION['logged_user'] = $user->fetchUser($_SESSION['logged_user']['username']);
if ($_SESSION['logged_user']['coins'] <= 0) {
    $user->deleteUser($_SESSION['logged_user']['user_id']);
    unset($_SESSION['logged_in']);
    unset($_SESSION['logged_user']);
    header("location: index.php");
    die();
}
?>
<div class="toast-container">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="..." class="rounded me-2" alt="...">
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>
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