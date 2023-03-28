    <div class="mb-3 p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="text-black dark:text-gray-500">@<?= htmlspecialchars($post["author_username"]) ?></div>
        <div class="text-gray-700 dark:text-white"><?= htmlspecialchars($post["text"]) ?></div>

        <?php if (isset($_SESSION['id'])) : ?>
            <div class="flex mt-3 gap-3">

                <a href="/posts/create?parent_post_id=<?= $post['id'] ?>" class="flex items-center hover:text-blue-700 dark:text-white">
                    Reply
                    <svg fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                        <path d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>

                <?php if ($_SESSION['id'] === $post['author_id']) : ?>
                    <a href="/posts/edit?id=<?= $post['id'] ?>" class="flex items-center hover:text-blue-700 dark:text-white">
                        Edit
                        <svg fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                        </svg>
                    </a>
                    <form method="POST" action="/posts" class="hover:text-red-700 dark:text-white">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                        <button type="submit" class="flex items-center">Delete<svg fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                            </svg>
                        </button>
                    </form>
                <?php endif ?>

                <form method="POST" action="/like" class="ml-auto dark:text-white">
                    <?php if ($post['liked']) : ?>
                        <input type="hidden" name="_method" value="DELETE">
                    <?php endif ?>

                    <input type="hidden" name="id" value=<?= $post["id"] ?>>
                    <button type="submit" class="flex items-center font hover:text-pink-300">
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