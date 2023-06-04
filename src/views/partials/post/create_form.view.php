<form method="POST" action="/posts" enctype="multipart/form-data" class="space-y-6 mb-16">
    <div>
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">What's on your mind?</h3>
        <textarea name="text" rows="4"
            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
            placeholder="Write your thoughts here..." required><?= old('text') ?></textarea>
        <?php if (flashed('errors')['text'] ?? false): ?>
            <div class="text-sm text-red-600 dark:text-red-500">
                <?= flashed('errors')['text'] ?>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const modal = new Modal(document.getElementById('create-post-modal'));
                    modal.show();
                });
            </script>
        <?php endif; ?>
    </div>

    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image_file_input">Upload
        image (optional)</label>
    <input
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
        id="image_file_input" name="image" type="file">

    <button type="submit"
        class="w-min text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>