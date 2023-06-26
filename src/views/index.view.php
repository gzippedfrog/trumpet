<?php view("partials/head") ?>

    <!-- Form -->
<?php if (isset($_SESSION["id"])): ?>
    <?php if (isset($post_to_edit)): ?>
        <?php view("partials/post/edit_form", ['post' => $post_to_edit]) ?>
    <?php elseif (isset($reply_to)): ?>
        <?php view("partials/post/reply_form", ['reply_to' => $reply_to]) ?>
    <?php else: ?>
        <?php view("partials/post/create_form") ?>
    <?php endif ?>
<?php endif ?>

    <!-- Posts -->
    <div class="flex flex-col flex-1">
        <?php foreach ($posts as $post): ?>
            <?php view("partials/post/card",
                compact('post', 'page', 'user_id')
            ) ?>
            <?php if ($post->replies ?? false): ?>
                <?php foreach ($post->replies as $post): ?>
                    <?php view("partials/post/card",
                        compact('post', 'page', 'user_id')
                    ) ?>
                <?php endforeach; ?>
            <?php endif ?>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
<?php view("partials/pagination", compact('prevPageUrl', 'nextPageUrl')) ?>

<?php view("partials/footer") ?>