<?php view("partials/head") ?>

<!-- Post modal -->
<?php if ($_SESSION["id"] ?? false): ?>
    <?php if ($post ?? false): ?>
        <?php view(
            "partials/post/edit_modal",
            ['post' => $post]
        ) ?>
    <?php else: ?>
        <?php view("partials/post/create_modal") ?>
    <?php endif ?>
<?php endif ?>

<!-- Posts -->
<?php foreach ($posts[''] as $post): ?>
    <?php view("partials/post/card", ['post' => $post]) ?>
    <!-- Post replies -->
    <?php if ($posts[$post['id']] ?? false): ?>
        <?php foreach (array_reverse($posts[$post['id']]) as $post_reply): ?>
            <?php view("partials/post/card", [
                'post' => $post_reply,
                'isReply' => true
            ]) ?>
        <?php endforeach; ?>
    <?php endif ?>
<?php endforeach; ?>

<?php view("partials/footer") ?>