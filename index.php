<?php
session_start();

$_SESSION['numOfTurns'] = 3;

if (isset($_POST['submit'])) {
    $user1 = trim($_POST['user1']);
    $user2 = trim($_POST['user2']);
    $user3 = trim($_POST['user3']);

    if ($user1 !== "" && $user2 !== "" && $user3 !== "") {
        $_SESSION['user1'] = $user1;
        $_SESSION['user2'] = $user2;
        $_SESSION['user3'] = $user3;

        echo "<script>window.location.href = 'sites/home.php';</script>";
        exit;
    } else {
        $error = "Please enter all three usernames.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gambling room</title>
    <link rel="stylesheet" href="style/style.css">

</head>

<body class="w-screen h-screen flex items-center justify-center bg-blend-color-burn bg-color-bg">
    <div class="border border-gray-300 rounded-md p-6 shadow-[8px_8px_0px_0px_var(--color-shadow)] bg-color-box">
        <form id="playerForm" action="" method="post" class="flex flex-col gap-4">

            <label for="user1">Player 1</label>
            <input type="text" name="user1" id="user1" placeholder="" class="border border-gray-300 rounded-md ">

            <label for="user2">Player 2</label>
            <input type="text" name="user2" id="user2" placeholder="" class="border border-gray-300 rounded-md ">

            <label for="user3">Player 3</label>
            <input type="text" name="user3" id="user3" placeholder="" class="border border-gray-300 rounded-md ">

            <input type="submit" value="startGame" name="submit" id="startGame">
        </form>
    </div>

    <script defer src="js/main.js"></script>
</body>

</html>