<?php
/**
 * @var Doctrine\ORM\Tools\Pagination\Paginator $posts
 * @var int $page
 * @var int $user_id
 * @var string $prevPageUrl
 * @var string $nextPageUrl
 */
?>

<?php view("partials/head") ?>

    <!-- Form -->
<?php if (isset($user_id)): ?>
    <?php if (isset($post_to_edit)): ?>
        <?php view("partials/post/edit_form", ['post' => $post_to_edit]) ?>
    <?php elseif (isset($parent_id)): ?>
        <?php view("partials/post/reply_form", ['parent_id' => $parent_id]) ?>
    <?php else: ?>
        <?php view("partials/post/create_form") ?>
    <?php endif ?>
<?php endif ?>

    <!-- Posts -->
<?php if (isset($posts)): ?>
    <div class="flex flex-col flex-1">
        <?php foreach ($posts as $post): ?>
            <?php view("partials/post/card", [
                'post' => $post,
                'page' => $page,
                'user_id' => $user_id
            ]) ?>
            <?php foreach ($post->getReplies() as $reply): ?>
                <?php view("partials/post/card", [
                    'post' => $reply,
                    'page' => $page,
                    'user_id' => $user_id
                ]) ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif ?>

    <!-- Pagination -->
<?php view("partials/pagination", compact(['prevPageUrl', 'nextPageUrl'])) ?>

<?php view("partials/footer") ?>