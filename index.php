<?php
session_start();

// clear old session after the finish page
if (isset($_GET['reset'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$_SESSION['numOfTurns'] = 3;

if (isset($_POST['submit'])) {
    $user1 = trim($_POST['user1']);
    $user2 = trim($_POST['user2']);
    $user3 = trim($_POST['user3']);

    if ($user1 !== "" && $user2 !== "" && $user3 !== "") {
        // reset old game data
        session_unset();

        // save players
        $_SESSION['user1'] = $user1;
        $_SESSION['user2'] = $user2;
        $_SESSION['user3'] = $user3;

        // prepare dice rolls
        $_SESSION['user1Rolls'] = [];
        $_SESSION['user2Rolls'] = [];
        $_SESSION['user3Rolls'] = [];
        $_SESSION['currentPlayer'] = 1;
        $_SESSION['rollsTaken'] = 0;
        $_SESSION['lastRoll'] = null;
        $_SESSION['lastPlayer'] = null;

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

<body class="w-screen h-screen flex items-center justify-center bg-blue-400">
    <div class="border-2 border-gray-900 rounded-lg p-6 shadow-[8px_8px_0px_0px_var(--color-gray-900)] bg-gray-50 flex flex-col gap-1">
        <h1 class="text-center font-bold mb-5">Gambling room</h1>
        <form id="playerForm" action="" method="post" class="flex flex-col gap-3">

            <label for="user1">First Player</label>
            <input type="text" name="user1" id="user1" placeholder="" class="border rounded-md border-black">

            <label for="user2">Second Player</label>
            <input type="text" name="user2" id="user2" placeholder="" class="border rounded-md border-black">

            <label for="user3">Third Player</label>
            <input type="text" name="user3" id="user3" placeholder="" class="border rounded-md border-black">

            <input type="submit" value="Start game" name="submit" id="startGame" class="inline-block px-4 py-2 text-base font-medium leading-tight text-gray-800 border-2 border-gray-900 rounded-lg bg-gray-50 shadow-[4px_4px_0px_0px_var(--color-gray-900)] cursor-pointer transition-all duration-100 active:translate-x-1 active:translate-y-1 active:shadow-none disabled:opacity-50">
        </form>
    </div>

    <script defer src="js/main.js"></script>
</body>

</html>