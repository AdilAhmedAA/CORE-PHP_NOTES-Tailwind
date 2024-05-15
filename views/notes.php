<ul role="list" class="divide-y divide-gray-100">
    <?php
    $count = 1;
    foreach ($notes as $note) : ?>
        <li class="block justify-between gap-x-6 py-5 md:flex md:flex-row-reverse">
            <div class="flex items-center gap-x-2 mb-4 md:mb-0 justify-end mr-3">
                <!-- Edit Button -->
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center" id="openModal<?php echo $count ?>">Edit</button>
                <!-- Delete Button -->
                <form action="" method="POST">
                    <input type="hidden" name="method" value="delete-note">
                    <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 inline-flex items-center">Delete</button>
                </form>
            </div>
            <div class="flex min-w-0 gap-x-4 justify-between w-full">
                <div class="flex-auto">
                    <p class="text-sm leading-6 text-gray-900 font-semibold"><?php echo $note['body']; ?></p>
                    <div class="block ml-auto mt-6">
                        <?php foreach ($users as $user) {
                            if ($user['id'] === $note['user_id']) { ?>
                                <p class="text-sm font-bold leading-6 text-red-900">Author : <?php echo $user['name']; ?></p>
                                <p class="mt-1 truncate text-xs leading-5 text-gray-500"><?php echo $user['email']; ?></p>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>

        </li>

        <div id="editModal<?php echo $count ?>" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" aria-labelledby="modal-title<?php echo $count ?>" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white p-6 rounded-lg w-full max-w-md">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl font-semibold">Edit Note</h1>
                        <button id="editModalClose<?php echo $count ?>" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <input type="hidden" name="method" value="edit-note">
                        <input type="hidden" name="note_id" id="editNoteId" value="<?php echo $note['id'] ?>">
                        <div class="mb-4">
                            <label for="editBody" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea name="body" id="editBody" rows="6" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter your note"><?php echo $note['body'] ?></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="editUser" class="block text-sm font-medium text-gray-700">User</label>
                            <select name="user" id="editUser" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <?php foreach ($users as $user) :
                                    if ($user['id'] === $note['user_id']) { ?>
                                        <option value="<?php echo $user['id']; ?>" selected><?php echo $user['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Update</button>
                    </form>
                </div>
            </div>
        </div>

    <?php
        echo "<script>
    document.getElementById('openModal$count').addEventListener('click', function() {
        document.getElementById('editModal$count').classList.remove('hidden');
    });
    document.getElementById('editModalClose$count').addEventListener('click', function() {
        document.getElementById('editModal$count').classList.add('hidden');
    });
</script>";
        $count++;
    endforeach; ?>
</ul>