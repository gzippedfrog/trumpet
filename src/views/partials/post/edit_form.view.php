<form method="POST" action="<?= "/posts?" . http_build_query($_GET) ?>" enctype="multipart/form-data" class="mb-16">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id" value="<?= $post->id ?>">

    <div class="space-y-6">
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edit post</h3>

        <textarea name="text" rows="4"
                  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                  placeholder="Write your thoughts here..." required><?= old('text', null) ?? $post->text ?></textarea>

        <?php if (flashed('errors')['text'] ?? false): ?>
            <div class="text-sm text-red-600 dark:text-red-500">
                <?= flashed('errors')['text'] ?>
            </div>
        <?php endif; ?>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image_file_input">Upload
                image (optional)</label>
            <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image_file_input" name="image" type="file">
        </div>

        <button type="submit"
                class="w-min text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            Submit
        </button>
    </div>
</form>