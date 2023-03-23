<?php view("partials/head") ?>

<!-- CREATE POST FORM -->
<?php if (isset($_SESSION["id"])) : ?>
    <form method="POST" action="/posts" class="flex flex-col gap-5 mb-6">
        <div class="dark:text-white text-lg font-bold">Crate new post</div>
        <textarea name="text" rows="4" placeholder="Write your thoughts here..." class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

        <?php if (isset($errors["text"])) : ?>
            <p class="text-sm text-red-600 dark:text-red-500"><?= $errors["text"] ?></p>
        <?php endif; ?>

        <input type="hidden" name="author_id" value=<?= $_SESSION["id"] ?>>
        <button type="submit" class="text-white self-start bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
<?php endif ?>

<!-- POSTS -->
<?php foreach ($posts as $post) : ?>
    <div class="mb-3 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="text-black dark:text-gray-500">@<?= $post["author_username"] ?></div>
        <div class="text-gray-700 dark:text-white"><?= $post["text"] ?></div>

        <?php if (isset($_SESSION['id'])) : ?>
            <div class="flex mt-3 gap-3">

                <?php if ($_SESSION['id'] === $post['author_id']) : ?>
                    <a href="/posts/edit?id=<?= $post['id'] ?>" class="flex items-center hover:text-blue-700 dark:text-white">
                        Edit
                        <svg fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                        </svg>
                    </a>
                    <form method="POST" action="/posts" class="flex items-center hover:text-red-700 dark:text-white">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                        <button type="submit">Delete</button>
                        <svg fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                        </svg>
                    </form>
                <?php endif ?>

                <form method="POST" action="/like" class="ml-auto dark:text-white">
                    <?php if ($post['liked']) : ?>
                        <input type="hidden" name="_method" value="DELETE">
                    <?php endif ?>

                    <input type="hidden" name="id" value=<?= $post["id"] ?>>
                    <button type="submit" class="flex items-center font hover:text-pink-700">
                        Like
                        <svg aria-hidden="true" fill="<?= $post["liked"] ? "currentColor" : "none" ?>" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16" xmlns="http://www.w3.org/2000/svg" class="ml-1">
                            <path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <?= $post["likes"] ?>
                    </button>
                </form>
            </div>
        <?php endif ?>
    </div>
<?php endforeach; ?>

<?php view("partials/footer") ?>