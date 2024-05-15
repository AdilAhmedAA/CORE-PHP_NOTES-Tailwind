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
            <input type="hidden" name="method" value="add-note">
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


    

    <!-- JavaScript -->
    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('myModal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('myModal').classList.add('hidden');
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