<?php

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

require_once './includes/header.php'
?>
<video id="bgVideo" preload="true" autoplay loop muted>
    <source src="./media/mixkit-casino-chips-and-dices-30830-medium.mp4" type="video/mp4" />
</video>
<main class="d-flex justify-content-center align-items-center flex-fill">
<?php if (!isset($_SESSION['logged_in'])) : ?>
    <form action="handle_login.php" method="post" class="col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <h2>WELCOME TO DEAL BREAKER</h2>
            </div>
            <div class="card-body">
                <p>EXPERIENCE CLASSIC CARD GAMES WITH A MODERN TWIST. CHALLENGE FRIENDS GLOBALLY OR CLIMB THE LEADERBOARDS. THE FUTURE OF CARD GAMING IS HERE-JOIN THE FUN!</p>
                <h3 style="font-size: 16px">ENTER A USERNAME TO JOIN, OR LEAVE IT BLANK TO GET A RANDOM ONE</h3>
                <input class="form-control" type="text" name="username" id="username" placeholder="USERNAME" autocomplete="off">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">JOIN</button>
    </form>
<?php else : ?>
    <?php $_SESSION['round_num'] = 0; ?>
    <form action="play.php" method="get" class="col-md-6">
        <div class="card">
            <div class="card-header pb-0">
                <h2>WELCOME TO DEAL BREAKER</h2>
            </div>
            <div class="card-body">
                <p>EXPERIENCE CLASSIC CARD GAMES WITH A MODERN TWIST. CHALLENGE FRIENDS GLOBALLY OR CLIMB THE LEADERBOARDS. THE FUTURE OF CARD GAMING IS HERE-JOIN THE FUN!</p>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">PLAY NOW</button>
    </form>
<?php endif ?>
</main>
<?php require_once './includes/footer.php' ?>