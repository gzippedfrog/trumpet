<div
        class="mb-3 bg-white rounded-lg shadow dark:text-white dark:bg-gray-800 dark:border-gray-200 <?= ($post->parent ?? false) ? 'ml-10' : '' ?>">
    <?php if ($post->image ?? false): ?>
        <img class="rounded-t-lg max-h-96 w-full object-contain bg-gray-300 dark:bg-gray-500"
             src="<?= "/images/{$post->image}" ?>" alt=""/>
    <?php endif ?>

    <div class="p-5">
        <div class="text-gray-500">
            <?= '@' . htmlspecialchars($post->author->username) ?>
        </div>
        <div>
            <?= htmlspecialchars($post->text) ?>
        </div>

        <!-- Interaction buttons -->
        <div class="flex mt-3 gap-3">
            <?php if (isset($user_id)): ?>
                <?php if (!($post->parent ?? false)): ?>
                    <!-- Reply Button -->
                    <a href="/posts/create?parent_id=<?= $post->id ?>&page=<?= $page ?>"
                       class="flex items-center hover:text-primary-500 dark:hover:text-primary-400">
                        Reply
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
                            </path>
                        </svg>
                    </a>
                <?php endif ?>

                <?php if ($user_id === $post->author->id): ?>
                    <!-- Edit Button -->
                    <a href="/posts/edit?id=<?= $post->id ?>&page=<?= $page ?>"
                       class="flex items-center hover:text-yellow-300 dark:hover:text-yellow-200">
                        Edit
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"
                             viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                            </path>
                        </svg>
                    </a>

                    <!-- Delete Button -->
                    <form method="POST" action="<?= "/posts?" . http_build_query($_GET) ?>"
                          class="hover:text-red-600 dark:hover:text-red-400">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="<?= $post->id ?>">
                        <button type="submit" class="flex items-center">
                            Delete
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" width="18" height="18"
                                 viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="inline ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                </path>
                            </svg>
                        </button>
                    </form>
                <?php endif ?>

                <!-- Like Button -->
                <form method="POST" action="<?= "/like?" . http_build_query($_GET) ?>" class=" ml-auto ">
                    <?php if ($post->isLikedBy($user_id)): ?>
                        <input type="hidden" name="_method" value="DELETE">
                    <?php endif ?>

                    <input type="hidden" name="id" value=<?= $post->id ?>>
                    <button type="submit" class="flex items-center hover:text-pink-400 dark:hover:text-pink-300">
                        Like
                        <svg aria-hidden="true" fill="<?= $post->isLikedBy($user_id) ? "currentColor" : "none" ?>"
                             stroke="currentColor"
                             stroke-width="1.5" viewBox="0 0 24 24" width="16" height="16"
                             xmlns="http://www.w3.org/2000/svg"
                             class="ml-1">
                            <path
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <?= count($post->likedBy) ?>
                    </button>
                </form>

            <?php else: ?>
                <div class="flex items-center ml-auto dark:text-white">
                    Likes
                    <svg aria-hidden="true"
                         fill="<?= $post->isLikedBy($user_id) ? "currentColor" : "none" ?>"
                         stroke="currentColor"
                         stroke-width="1.5" viewBox="0 0 24 24" width="16" height="16"
                         xmlns="http://www.w3.org/2000/svg"
                         class="ml-1">
                        <path
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <?= count($post->likedBy) ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>