<?php

use DealBreaker\Model\User;

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

$user = new User();
$users = $user->fetchUsers();

require_once './includes/header.php'
?>
<video id="bgVideo" preload="true" autoplay loop muted>
    <source src="./media/mixkit-casino-chips-and-dices-30830-medium.mp4" type="video/mp4" />
</video>
<main class="flex-fill container d-flex align-items-center">
    <table class="table table-dark" style="background-color: transparent;">
        <thead>
            <tr>
                <th class="col">RANK</th>
                <th class="col">USERNAME</th>
                <th class="col">COINS</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php for ($i = 0; $i < 10; $i++) : ?>
                <tr>
                    <th scope="row"><?= $i + 1 ?></th>
                    <td><?= isset($users[$i]['username']) ? $users[$i]['username'] : '-' ?></td>
                    <td><?= isset($users[$i]['coins']) ? number_format($users[$i]['coins']) : '-' ?></td>
                </tr>
            <?php endfor ?>
        </tbody>
    </table>
</main>
<?php require_once './includes/footer.php' ?>