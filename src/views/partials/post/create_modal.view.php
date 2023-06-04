<!-- Modal toggle -->
<button data-modal-target="create-post-modal" data-modal-show="create-post-modal"
    class="inline-block max-w-max mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button" on>
    Create new post
</button>

<!-- Main modal -->
<div id="create-post-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-hide="create-post-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <form method="POST" action="/posts" enctype="multipart/form-data" class="space-y-6">
                    <div>
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">What's on your mind?</h3>
                        <textarea name="text" rows="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
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
                        <input type="hidden" name="author_id" value=<?= $_SESSION["id"] ?>>
                    </div>

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="image_file_input">Upload
                        image (optional)</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="image_file_input" name="image" type="file">

                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>