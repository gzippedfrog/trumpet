<?php view('partials/head') ?>

<!-- CREATE POST FORM -->
<?php if (isset($_SESSION['username'])) : ?>
    <form method="POST" class="flex flex-col gap-5 mb-6">
        <div class="text-white text-lg font-bold">Crate new post</div>

        <textarea name="text" rows="4" placeholder="Write your thoughts here..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

        <?php if (isset($errors['text'])) : ?>
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><?= $errors['text'] ?></p>
        <?php endif; ?>

        <input type="hidden" name="author_id" value=<?= $_SESSION['user_id'] ?>>

        <button type="submit" class="text-white self-start bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
<?php endif ?>

<!-- POSTS -->
<?php foreach ($posts as $post) : ?>
    <div class="mb-3 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="font-bold text-black dark:text-gray-500">@<?= $post["author_username"] ?></div>
        <div class="mb-3 font-normal text-gray-700 dark:text-white"><?= $post["text"] ?></div>
        <a href="like/<?= $post['id'] ?>" class="flex gap-1 items-center dark:text-white">
            <svg aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span><?= $post['likes'] ?></span>
        </a>
    </div>
<?php endforeach; ?>

<?php view('partials/footer') ?>