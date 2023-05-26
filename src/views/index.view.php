<?php view("partials/head") ?>

<!-- Create post form -->
<?php if (isset($_SESSION["id"])): ?>
    <form method="POST" action="/posts" class="mb-6">
        <div class="dark:text-white text-lg font-bold mb-3">Crate new post</div>
        <textarea name="text" rows="4" placeholder="Write your thoughts here..."
            class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><?= old('text') ?></textarea>

        <?php if (flashed('errors')['text'] ?? false): ?>
            <div class="text-sm text-red-600 dark:text-red-500">
                <?= flashed('errors')['text'] ?>
            </div>
        <?php endif; ?>

        <input type="hidden" name="author_id" value=<?= $_SESSION["id"] ?>>
        <button type="submit"
            class="text-white self-start bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-3">Submit</button>
    </form>
<?php endif ?>

<!-- Posts -->
<?php foreach ($posts[NULL] as $post): ?>
    <?php view("partials/post_card", ['post' => $post]) ?>

    <!-- Post replies -->
    <?php if (array_key_exists($post['id'], $posts)): ?>
        <?php foreach (array_reverse($posts[$post['id']]) as $post_reply): ?>
            <?php view("partials/post_card", ['post' => $post_reply, 'isReply' => true]) ?>
        <?php endforeach; ?>
    <?php endif ?>
<?php endforeach; ?>

<?php view("partials/footer") ?>