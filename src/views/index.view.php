<?php view("partials/head") ?>

<?php if (isset($_SESSION["id"])): ?>
    <?php view("partials/post/create_form") ?>
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

<!-- Post edit modal -->
<?php if (isset($_SESSION["id"], $post_to_edit)): ?>
    <?php view(
        "partials/post/edit_modal",
        ['post' => $post_to_edit]
    ) ?>
<?php endif ?>

<?php view("partials/footer") ?>