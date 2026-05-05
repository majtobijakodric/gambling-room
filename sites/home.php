<?php
session_start();

if (!isset($_SESSION['user1'], $_SESSION['user2'], $_SESSION['user3'])) {
    header('Location: ../index.php');
    exit;
}

$players = [
    1 => $_SESSION['user1'],
    2 => $_SESSION['user2'],
    3 => $_SESSION['user3'],
];

foreach (array_keys($players) as $playerNumber) {
    $_SESSION["user{$playerNumber}Score"] ??= 0;
}

$_SESSION['currentPlayer'] ??= 1;
$_SESSION['rollsTaken'] ??= 0;
$_SESSION['lastRoll'] ??= null;
$_SESSION['lastPlayer'] ??= null;
$_SESSION['gameFinished'] ??= false;

$totalRolls = count($players) * ($_SESSION['numOfTurns'] ?? 3);

if (isset($_POST['rollDice']) && !$_SESSION['gameFinished']) {
    $rollingPlayer = $_SESSION['currentPlayer'];
    $roll = rand(1, 6);

    $_SESSION["user{$rollingPlayer}Score"] += $roll;
    $_SESSION['lastRoll'] = $roll;
    $_SESSION['lastPlayer'] = $rollingPlayer;
    $_SESSION['rollsTaken']++;

    if ($_SESSION['rollsTaken'] >= $totalRolls) {
        $_SESSION['gameFinished'] = true;
    } else {
        $_SESSION['currentPlayer'] = $rollingPlayer === count($players) ? 1 : $rollingPlayer + 1;
    }
}

$currentPlayer = $_SESSION['currentPlayer'];
$diceImage = $_SESSION['lastRoll'] ? "dice" . $_SESSION['lastRoll'] . ".gif" : 'dice-anim.gif';
$turnMessage = $_SESSION['gameFinished']
    ? 'Game finished'
    : 'Rolling for ' . $players[$currentPlayer];

function e($value)
{
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
    <div class="w-160 h-100 border-2 border-gray-900 rounded-lg p-6 shadow-[8px_8px_0px_0px_var(--color-gray-900)] bg-gray-50 flex flex-col gap-1">
        <div class="flex w-full h-full">
            <!-- player info -->
            <div class="w-1/3 h-full pr-5 border-r-2 border-r-black">
                <ul role="list" class="flex h-full flex-col divide-y divide-white/5">
                    <?php foreach ($players as $playerNumber => $playerName): ?>
                        <?php $isSelected = $currentPlayer === $playerNumber && !$_SESSION['gameFinished']; ?>
                        <li class="flex flex-1 items-center justify-between gap-x-6 rounded-3xl p-3 <?php echo $isSelected ? 'border-2 border-gray-900 bg-gray-800/5' : 'border-2 border-transparent'; ?>" <?php echo $isSelected ? 'aria-current="true"' : ''; ?>>
                            <div class="flex min-w-0 gap-x-4">
                                <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                                <div class="min-w-0 flex-auto">
                                    <p class="text-sm/6 font-semibold text-black">
                                        <?php echo e($playerName); ?>
                                    </p>
                                    <p class="truncate text-xs/5 text-gray-400">
                                        Score: <?php echo (int) $_SESSION["user{$playerNumber}Score"]; ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>



            <!-- dice -->
            <div class="w-full h-full p-4 flex flex-col items-center">
                <p class="text-lg font-bold text-gray-900"><?php echo e($turnMessage); ?></p>

                <img src="../assets/<?php echo e($diceImage); ?>" alt="dice" width="200" height="200">

                <form method="post" class="mt-auto self-center">
                    <button type="submit" name="rollDice" <?php echo $_SESSION['gameFinished'] ? 'disabled' : ''; ?> class="relative inline-block text-base group active:translate-x-1 active:translate-y-1 disabled:opacity-50">
                        <span class="relative z-10 block px-4 py-2 font-medium leading-tight text-gray-800 border-2 border-gray-900 rounded-lg bg-gray-50">
                            <?php echo $_SESSION['gameFinished'] ? 'Game over' : 'Roll dice'; ?>
                        </span>

                        <span class="absolute bottom-0 right-0 w-full h-10 -mb-1 -mr-1 bg-gray-900 rounded-lg transition-all duration-100 group-active:mb-0 group-active:mr-0"></span>
                    </button>
                </form>

            </div>


        </div>
    </div>


</body>

</html>
