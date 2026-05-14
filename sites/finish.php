<?php
session_start();

if (!isset($_SESSION['user1'], $_SESSION['user2'], $_SESSION['user3'])) {
    header('Location: ../index.php');
    exit;
}

// calculate player scores
$user1Score = array_sum($_SESSION['user1Rolls'] ?? []);
$user2Score = array_sum($_SESSION['user2Rolls'] ?? []);
$user3Score = array_sum($_SESSION['user3Rolls'] ?? []);

// find the highest score
$highestScore = max($user1Score, $user2Score, $user3Score);

$winnerText = "";

// add every winner to the text
if ($user1Score == $highestScore) {
    $winnerText = $_SESSION['user1'];
}

if ($user2Score == $highestScore) {
    if ($winnerText != "") {
        $winnerText .= ", ";
    }

    $winnerText .= $_SESSION['user2'];
}

if ($user3Score == $highestScore) {
    if ($winnerText != "") {
        $winnerText .= ", ";
    }

    $winnerText .= $_SESSION['user3'];
}

// prepare leaderboard
$players = [
    ['name' => $_SESSION['user1'], 'score' => $user1Score],
    ['name' => $_SESSION['user2'], 'score' => $user2Score],
    ['name' => $_SESSION['user3'], 'score' => $user3Score],
];

// sort players by score
usort($players, function ($a, $b) {
    return $b['score'] - $a['score'];
});

function e($value)
{
    // htmlspecialchars converts special characters (like <, >, &, " and ') in a string into their corresponding HTML entities so they display safely in a webpage.
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gambling room</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/clouds.css">
    <link rel="stylesheet" href="../style/font.css">
    <style>
        .cloud {
            animation-delay: -<?php echo round(microtime(true), 3); ?>s;
        }
    </style>
</head>

<body class="w-screen h-screen flex items-center justify-center bg-blue-400">
    <div class="cloud-stage">
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

    <div class="relative z-10 w-160 h-100 border-2 border-gray-900 rounded-lg p-6 shadow-[8px_8px_0px_0px_var(--color-gray-900)] bg-gray-50 flex flex-col gap-3  scale-150">
        <h1 class="text-center font-bold mb-5">Score board</h1>

        <!-- leaderboard -->
        <div class="flex flex-col gap-3 h-full">
            <div class="flex w-full h-full">
                <div id="second" class="w-1/3 text-center flex flex-col">
                    <div class="mt-auto mb-1">
                        <p class="font-semibold text-slate-500"><?php echo e($players[1]['name']); ?></p>
                        <p>Score: <?php echo $players[1]['score']; ?></p>
                    </div>
                    <div class="bg-slate-500 h-30 border-2 border-gray-900 rounded-lg rounded-b-none"></div>
                </div>
                <div id="first" class="mr-4 ml-4 w-1/3 h-full text-center flex flex-col ">
                    <div class="mt-auto mb-1">
                        <p class="font-semibold text-blue-600"><?php echo e($players[0]['name']); ?></p>
                        <p>Score: <?php echo $players[0]['score']; ?></p>
                    </div>
                    <div class="bg-blue-500 h-50 border-2 border-gray-900 rounded-lg rounded-b-none"></div>
                </div>
                <div id="third" class="w-1/3 h-full text-center flex flex-col">
                    <div class="mt-auto mb-1">
                        <p class="font-semibold text-gray-900"><?php echo e($players[2]['name']); ?></p>
                        <p>Score: <?php echo $players[2]['score']; ?></p>
                    </div>
                    <div class="bg-gray-900 h-11 border-2 border-gray-900 rounded-lg rounded-b-none"></div>
                </div>
            </div>
        </div>

        <!-- shows time left til redirect -->
        <div class="text-center mt-auto">
            <p class="text-xs text-black">Redirecting in <span id="countdown">10</span> seconds...</p>
        </div>
    </div>


    <script>
        // go back to the first page after 10 seconds
        let timeLeft = 10;
        const countdownElement = document.getElementById('countdown');

        const countdownInterval = setInterval(function() {
            timeLeft--;
                countdownElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '../index.php?reset=1';
            }
        }, 1000);
    </script>
</body>

</html>
