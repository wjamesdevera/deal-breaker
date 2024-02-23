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

    <img src=<?= './img/cards/' . $game->getDealtCards()[0] . '.png' ?> alt="" width="100rem">
    <img src=<?= './img/cards/' . $game->getDealtCards()[1] . '.png' ?> alt="" width="100rem">
    <img src=<?= './img/cards/' . $game->getPlayerCard() . '.png' ?> alt="" width="100rem">
    <?php if (isset($_POST['pair_choice'])) : ?>
        <?php
        if (isset($_POST['bet']) && isset($_POST['choice'])) {
            $result = $game->determineOutcome($_POST['pair_choice']);
            if ($result == 'win_pair' && $_POST['choice'] == 'deal') {
                $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + ($_POST['bet'] * 3)));
                echo "You Won!";
            } else if ($result == 'lose_match' && $_POST['choice'] == 'deal') {
                $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] - $_POST['bet']));
                echo "You Lose!";
            }
        }
        ?>
    <?php else :
        if (isset($_POST['bet']) && isset($_POST['choice']) && !isset($_POST['pair_choice'])) {
            $result = $game->determineOutcome();
            if ($result == 'win_inbetween' && $_POST['choice'] == 'deal') {
                $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] + ($_POST['bet'] * 2)));
                echo "You Won!";
            } else if ($result == 'lose_match' && $_POST['choice'] == 'deal') {
                $user->updateUser($_SESSION['logged_user']['user_id'], $_SESSION['logged_user']['username'], ($_SESSION['logged_user']['coins'] - $_POST['bet']));
                echo "You Lose!";
            }
        } else
    ?>
    <?php endif ?>
    <br>
    <button><a href="play.php">Play Again</a></button>
<?php else : ?>
    <?php
    $_SESSION['round_cards'] = $_SESSION['game']->dealTwoCards();
    $deal = $_SESSION['round_cards'];
    ?>
    <img src=<?= './img/cards/' . $game->getDealtCards()[0] . '.png' ?> alt="" width="100rem">
    <img src=<?= './img/cards/' . $game->getDealtCards()[1] . '.png' ?> alt="" width="100rem">
    <?php if ($deal['pair']) : ?>
        <form action="play.php" method="post">
            <p id="betRange">10</p>
            <input id="choiceRange" type="range" name="bet" min="10" max="<?= $_SESSION['logged_user']['coins'] ?>" value="10" step="10" data-sizing="px">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pair_choice" id="high" value="high" checked />
                <label class="form-check-label" for="high"> High </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pair_choice" id="low" value="low" />
                <label class="form-check-label" for="low"> Low </label>
            </div>

            <button name="choice" value="deal">Deal</button>
            <button name="choice" value="no_deal">No Deal</button>
        </form>
    <?php else : ?>
        <form action="play.php" method="post">
            <p id="betRange"><?= (floor($_SESSION['logged_user']['coins'] * .1)) ?></p>
            <input id="choiceRange" type="range" name="bet" min="<?= (floor($_SESSION['logged_user']['coins'] * .1)) ?>" max="<?= $_SESSION['logged_user']['coins'] ?>" value="<?= floor(($_SESSION['logged_user']['coins'] * .1)) ?>" step="<?= floor(($_SESSION['logged_user']['coins'] * .1)) ?>" data-sizing="px">
            <button name="choice" value="deal">Deal</button>
            <button name="choice" value="no_deal">No Deal</button>
        </form>
    <?php endif ?>
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
<script>
    const choiceRange = document.querySelector('#choiceRange');

    choiceRange.addEventListener('change', () => {
        console.log(choiceRange.value);
        document.querySelector('#betRange').innerHTML = choiceRange.value;
    })
</script>