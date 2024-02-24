<?php

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

require_once "./includes/header.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Home</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&family=Khand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Handjet:wght@100..900&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/about.css">
</head>

<main class="container">
    <h2>HOW TO PLAY</h2>
        <p>Deal Breaker is a variation of the classic card game In-Between, also known as Acey-Deucey. While it shares similarities with Red Dog, the rules of Deal Breaker provide a unique and exciting gaming experience.</p>
        <h4>HOW TO PLAY DEAL BREAKER</h4>
            <p>The cards rank from highest to lowest as follows: A (high), K, Q, J, 10, 9, 8, 7, 6, 5, 4, 3, 2.</p>
        <h4>OBJECTIVE</h4>
            <p>The objective of Deal Breaker is simple: accumulate the most chips by the end of the game.</p>

        <p></p>
        <h3>GAMEPLAY</h3>
        <p></p>

        <h4>SETUP</h4>
            <p>Two face-up cards are dealt on the table to initiate each round.</p>
        <h4>Betting</h4>
            <p>Players place their bets, determining the amount of chips wagered in the round.</p>
            <p>The payout ratios for different outcomes are as follows:</p>
                <div class="row">
                    <div class="col-md-4">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                            <td>OUTCOME</td>
                            <td>PAYOUT RATIO</td>
                            </tr>
                            <tr>
                            <td>WIN IN BETWEEN</td>
                            <td>1:2</td>
                            </tr>
                            <tr>
                            <td>WIN BY PAIR</td>
                            <td>1:3</td>
                            </tr>
                            <tr>
                            <td>LOSE MATCH</td>
                            <td>-1</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
        <h4>MAKING A CHOICE</h4>
            <p>Players must determine if their next card will fall in between the ranks of the two face-up cards. <br> 
            If the player's card falls between the two given cards, they win according to the payout ratio. <br>
            If the player's card does not fall between the two given cards, they lose their bet for that round.</p>
        <h4>SPECIAL CASES</h4>
            <p>If the two face-up cards are of the same rank, players must predict if their next card will be higher or lower in value. <br>
            A correct prediction results in a win, while an incorrect prediction results in a loss.</p>
            <h4>ROUND LIMIT</h4>
            <p>Each player is given 10 rounds to play, allowing for strategic betting and gameplay.</p>
</main>
<?php require_once './includes/footer.php'; ?>