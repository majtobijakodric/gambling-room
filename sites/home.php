<?php
session_start();

if (!isset($_SESSION['user1'], $_SESSION['user2'], $_SESSION['user3'])) {
    header('Location: ../index.php');
    exit;
}

$_SESSION['user1Rolls'] ??= [];
$_SESSION['user2Rolls'] ??= [];
$_SESSION['user3Rolls'] ??= [];
$_SESSION['currentPlayer'] ??= 1;
$_SESSION['rollsTaken'] ??= 0;
$_SESSION['lastRoll'] ??= null;
$_SESSION['lastPlayer'] ??= null;

// save one dice roll for the current player
if (isset($_POST['rollDice']) && $_SESSION['rollsTaken'] < 9) {
    $roll = rand(1, 6);
    $_SESSION['lastRoll'] = $roll;
    $_SESSION['lastPlayer'] = $_SESSION['currentPlayer'];

    if ($_SESSION['currentPlayer'] == 1) {
        $_SESSION['user1Rolls'][] = $roll;
    }

    if ($_SESSION['currentPlayer'] == 2) {
        $_SESSION['user2Rolls'][] = $roll;
    }

    if ($_SESSION['currentPlayer'] == 3) {
        $_SESSION['user3Rolls'][] = $roll;
    }

    $_SESSION['rollsTaken']++;

    // go to finish page after all players rolled three times
    if ($_SESSION['rollsTaken'] >= 9) {
        echo "<script>window.location.href = 'finish.php';</script>";
        exit;
    }

    $_SESSION['currentPlayer']++;

    if ($_SESSION['currentPlayer'] > 3) {
        $_SESSION['currentPlayer'] = 1;
    }
}

// go to finish page if the game is already done
if ($_SESSION['rollsTaken'] >= 9) {
    echo "<script>window.location.href = 'finish.php';</script>";
    exit;
}

$currentPlayer = $_SESSION['currentPlayer'];
$diceImage = $_SESSION['lastRoll'] ? "dice" . $_SESSION['lastRoll'] . ".gif" : 'dice-anim.gif';
$turnMessage = 'Rolling for ' . $_SESSION['user1'];

if ($currentPlayer == 2) {
    $turnMessage = 'Rolling for ' . $_SESSION['user2'];
}

if ($currentPlayer == 3) {
    $turnMessage = 'Rolling for ' . $_SESSION['user3'];
}

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
            <div class="w-1/3 h-full border-r-2 border-r-black">
                <ul role="list" class="flex h-full flex-col divide-y divide-white/5 mr-15 w-full">
                    <!-- first player -->
                    <li class="flex flex-1 items-center justify-between gap-x-6 rounded-3xl p-3 <?php echo $currentPlayer == 1 ? 'border-2 border-gray-900 bg-gray-800/5' : 'border-2 border-transparent'; ?> w-fit">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-black"><?php echo e($_SESSION['user1']); ?></p>
                                <div class="flex gap-1">
                                    <?php if (isset($_SESSION['user1Rolls'][0])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user1Rolls'][0]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user1Rolls'][1])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user1Rolls'][1]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user1Rolls'][2])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user1Rolls'][2]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- second player -->
                    <li class="flex flex-1 items-center justify-between gap-x-6 rounded-3xl p-3 <?php echo $currentPlayer == 2 ? 'border-2 border-gray-900 bg-gray-800/5' : 'border-2 border-transparent'; ?> w-fit">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-black"><?php echo e($_SESSION['user2']); ?></p>
                                <div class="flex gap-1">
                                    <?php if (isset($_SESSION['user2Rolls'][0])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user2Rolls'][0]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user2Rolls'][1])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user2Rolls'][1]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user2Rolls'][2])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user2Rolls'][2]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- third player -->
                    <li class="flex flex-1 items-center justify-between gap-x-6 rounded-3xl p-3 <?php echo $currentPlayer == 3 ? 'border-2 border-gray-900 bg-gray-800/5' : 'border-2 border-transparent'; ?> w-fit">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-black"><?php echo e($_SESSION['user3']); ?></p>
                                <div class="flex gap-1">
                                    <?php if (isset($_SESSION['user3Rolls'][0])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user3Rolls'][0]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user3Rolls'][1])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user3Rolls'][1]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['user3Rolls'][2])): ?>
                                        <img src="../assets/dice<?php echo (int) $_SESSION['user3Rolls'][2]; ?>.gif" alt="dice" class="size-8">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>



            <!-- dice -->
            <div class="w-full h-full p-4 flex flex-col items-center">
                <p class="text-lg font-bold text-gray-900"><?php echo e($turnMessage); ?></p>

                <img src="../assets/<?php echo e($diceImage); ?>" alt="dice" width="200" height="200">

                <form method="post" class="mt-auto self-center">
                    <button type="submit" name="rollDice" class="relative inline-block text-base group active:translate-x-1 active:translate-y-1 disabled:opacity-50 cursor-pointer">
                        <span class="relative z-10 block px-4 py-2 font-medium leading-tight text-gray-800 border-2 border-gray-900 rounded-lg bg-gray-50">
                            Roll dice
                        </span>

                        <span class="absolute bottom-0 right-0 w-full h-10 -mb-1 -mr-1 bg-gray-900 rounded-lg transition-all duration-100 group-active:mb-0 group-active:mr-0"></span>
                    </button>
                </form>

            </div>


        </div>
    </div>


</body>

</html>