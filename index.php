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
    <link rel="stylesheet" href="style/clouds.css">
    <link rel="shortcut icon" href="assets/icons8-cloud-96.png" type="image/x-icon">
    <style>
        .cloud {
            animation-delay: -<?php echo round(microtime(true), 3); ?>s;
        }
    </style>

</head>

<body class="w-screen h-screen">
    <div class="w-screen h-screen flex items-center justify-center bg-blue-400">
        <div class="cloud-stage" aria-hidden="true">
            <div class="cloud large cloud-1">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud normal cloud-2">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud small cloud-3">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud tiny cloud-4">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud large cloud-5">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud normal cloud-6">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud small cloud-7">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud tiny cloud-8">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud small cloud-9">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud normal cloud-10">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud tiny cloud-11">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="cloud small cloud-12">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <!-- by default hidden about menu -->
        <div id="aboutMenu" class="fixed hidden z-100 w-screen h-screen">
            <div class="flex items-center justify-center w-full h-full">
                <div class="relative z-10 border-2 border-gray-900 rounded-lg p-6 shadow-[8px_8px_0px_0px_var(--color-gray-900)] bg-gray-50 flex flex-col gap-1 justify-center">
                    <p class="text-center  mb-5">Hi there this is made by <a href="https://github.com/majtobijakodric" target="_blank" class="font-extrabold hover:text-blue-300">Maj Tobija Kodrič</a></p>
                </div>
            </div>
        </div>

        <!-- about menu button -->
        <div class="fixed bottom-1 right-1.5 cursor-pointer z-100">
            <button onclick="toggleAboutMenu()"> <img src="assets/aboutCloud.png" alt="aboutCloud" width="55px" height="55px"></button>
        </div>

        <div id="mainForm" class="relative z-10 border-2 border-gray-900 rounded-lg p-6 shadow-[8px_8px_0px_0px_var(--color-gray-900)] bg-gray-50 flex flex-col gap-1">
            <h1 class="text-center font-bold mb-5">Gambling room</h1>
            <form id="playerForm" action="" method="post" class="flex flex-col gap-3">

                <input type="text" name="user1" id="user1" placeholder="First Player" class="border rounded-md p-2 border-black mb-1">

                <input type="text" name="user2" id="user2" placeholder="Second Player" class="border rounded-md border-black p-2 mb-1">

                <input type="text" name="user3" id="user3" placeholder="Third Player" class="border rounded-md border-black p-2 mb-4">

                <input type="submit" value="Start game" name="submit" id="startGame" class="inline-block px-4 py-2 text-base font-medium leading-tight text-gray-800 border-2 border-gray-900 rounded-lg bg-gray-50 shadow-[4px_4px_0px_0px_var(--color-gray-900)] cursor-pointer transition-all duration-100 active:translate-x-1 active:translate-y-1 active:shadow-none disabled:opacity-50">
            </form>
        </div>
    </div>


    <script defer src="js/main.js"></script>
</body>

</html>