<?php
session_start();
$_SESSION['user1Score'] = 0;
$_SESSION['user2Score'] = 0;
$_SESSION['user3Score'] = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gambling room</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body class="w-screen h-screen flex items-center justify-center">

    <div class="w-160 h-100 border border-gray-300 rounded-md p-6 shadow-[8px_8px_0px_0px_var(--color-shadow)] bg-color-box bg-gray-500 flex flex-col gap-1">

        <div class="flex w-full h-full">

            <!-- player info -->
            <div class="w-1/3 h-full border-r border-r-black">
                <ul role="list" class="flex h-full flex-col divide-y divide-white/5">
                    <li class="flex flex-1 items-center justify-between gap-x-6">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-white">
                                    <?php echo $_SESSION['user1']; ?>
                                </p>
                                <p class="mt-1 truncate text-xs/5 text-gray-400">
                                    Score: <?php echo $_SESSION['user1Score']; ?>
                                </p>
                            </div>
                        </div>
                    </li>

                    <li class="flex flex-1 items-center justify-between gap-x-6">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-white">
                                    <?php echo $_SESSION['user2']; ?>
                                </p>
                                <p class="mt-1 truncate text-xs/5 text-gray-400">
                                    Score: <?php echo $_SESSION['user2Score']; ?>
                                </p>
                            </div>
                        </div>
                    </li>

                    <li class="flex flex-1 items-center justify-between gap-x-6">
                        <div class="flex min-w-0 gap-x-4">
                            <img src="../assets/user.png" alt="" class="size-12 flex-none rounded-full " />
                            <div class="min-w-0 flex-auto">
                                <p class="text-sm/6 font-semibold text-white">
                                    <?php echo $_SESSION['user3']; ?>
                                </p>
                                <p class="mt-1 truncate text-xs/5 text-gray-400">
                                    Score: <?php echo $_SESSION['user3Score']; ?>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- dice -->
            <div class="w-1/2 h-full">
            </div>


        </div>


</body>

</html>
