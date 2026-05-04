<?php
session_start();

$numOfTurns = 3;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gambling room</title>a
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body>
    <form action="" method="post">
        <label for="name1"></label>
        <input type="text" name="name1" id="name1" placeholder="Player 1 name">

        <label for="name2"></label>
        <input type="text" name="name2" id="name2" placeholder="Player 2 name">

        <label for="name3"></label>
        <input type="text" name="name3" id="name3" placeholder="Player 3 name">

        <button type="submit" name="start">Start game</button>
    </form>

    <?php


    ?>
    <script defer src="js/main.js"></script>
</body>

</html>