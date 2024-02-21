<?php
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if (isset($_SESSION["logged_in"]) && $_SESSION['logged_in'] == true) {
    echo "Welcome " . $_SESSION['logged_user']['username'];
}

?>

<form action="handle_logout.php" method="post">
    <button type="submit">Logout</button>
</form>
