<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="">
</head>

<body class="h-full">
    <div class="min-h-full">
        <?php require('views/partials/nav.php') ?>
        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Notes</h1>
                    <button id="openModal" class="bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Add Notes
                    </button>
                </div>
            </div>

        </header>
        <main>
            <div class="mx-auto max-w-7xl py-6 px-3 sm:px-6 lg:px-8">

                <?php require('views/notes.php') ?>

            </div>
        </main>
    </div>
    <!-- Modal -->
    <div id="myModal" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md mx-auto mt-20">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-semibold">Adding Notes</h1>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form action="" method="POST">
                <input type="hidden" name="FormAction" value="add-note">
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700">Note</label>
                    <textarea name="body" id="body" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter your note"></textarea>
                </div>
                <div class="mb-4">
                    <label for="user" class="block text-sm font-medium text-gray-700">User</label>
                    <select name="user" id="user" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
            </form>
        </div>
    </div>


    <button id="popup-toggler" class="hidden popup-modal block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Toggle modal
    </button>

    <div id="popup-modal" tabindex="-1" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md mx-auto mt-20">
            <div class="relative">
                <div class="p-4 md:p-5 text-center">
                    <?php
                    if (isset($_SESSION['msg'])) { ?>
                        <svg class="mx-auto mb-4 text-green-500 w-12 h-12 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    <?php } elseif (isset($_SESSION['er'])) {
                    ?>
                        <svg class="mx-auto mb-4 text-red-500 w-12 h-12 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    <?php
                    } ?>

                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"><?php
                                                                                            if (isset($_SESSION['msg'])) {
                                                                                                echo $_SESSION['msg'];
                                                                                            } elseif (isset($_SESSION['er'])) {
                                                                                                echo $_SESSION['er'];
                                                                                            } ?></h3>
                    <button class="close-modal text-white
                      
                      <?php
                        if (isset($_SESSION['msg'])) {
                            ?> bg-green-600  <?php
                        } elseif (isset($_SESSION['er'])) {
                            ?> bg-red-600  <?php
                        } ?>
                      hover:bg-blue-800  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <?php

    if (isset($_SESSION['msg']) || isset($_SESSION['er'])) {
        $script = '<script>
        document.getElementById("popup-toggler").addEventListener("click", function() {
                document.getElementById("popup-modal").classList.remove("hidden");
            });
            setTimeout(function() {
                document.querySelector(".popup-modal").click(); // Click the popup-modal after a delay
            }, 200);
        </script>';
        echo $script;
        unset($_SESSION['msg']);
        unset($_SESSION['er']);
    }
    ?>
    <!-- JavaScript -->
    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('myModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('myModal').classList.add('hidden');
        });


        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('popup-modal').classList.add('hidden');
        });

        window.addEventListener('click', function(event) {
            const modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>