<?php view("partials/head") ?>

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
<?php foreach ($posts[''] as $post): ?>
    <?php view("partials/post/card", ['post' => $post]) ?>
    <?php if ($posts[$post['id']] ?? false): ?>
        <!-- Post replies -->
        <?php foreach (array_reverse($posts[$post['id']]) as $post_reply): ?>
            <?php view("partials/post/card", [
                'post' => $post_reply,
                'isReply' => true
            ]) ?>
        <?php endforeach; ?>
    <?php endif ?>
<?php endforeach; ?>

<?php view("partials/footer") ?>