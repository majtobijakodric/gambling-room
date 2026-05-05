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
</head>

<body class="w-screen h-screen flex items-center justify-center bg-blue-400">
    <div class="w-160 h-100 border-2 border-gray-900 rounded-lg p-6 shadow-[8px_8px_0px_0px_var(--color-gray-900)] bg-gray-50 flex flex-col gap-3">
        <h1 class="text-center font-bold mb-5">Score board</h1>

        <!-- leaderboard -->
        <div class="flex flex-col gap-3">
            <!-- first player result -->
            <div class="flex items-center justify-between border-2 border-gray-900 rounded-lg p-2">
                <p class="font-semibold"><?php echo e($players[0]['name']); ?></p>
                <p><?php echo $players[0]['score']; ?></p>
            </div>

            <!-- second player result -->
            <div class="flex items-center justify-between border-2 border-gray-900 rounded-lg p-2">
                <p class="font-semibold"><?php echo e($players[1]['name']); ?></p>
                <p><?php echo $players[1]['score']; ?></p>
            </div>

            <!-- third player result -->
            <div class="flex items-center justify-between border-2 border-gray-900 rounded-lg p-2">
                <p class="font-semibold"><?php echo e($players[2]['name']); ?></p>
                <p><?php echo $players[2]['score']; ?></p>
            </div>
        </div>

        <!-- shows time left til redirect -->
        <div class="text-center mt-4">
            <p class="text-gray-600">Redirecting in <span id="countdown">10</span> seconds...</p>
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