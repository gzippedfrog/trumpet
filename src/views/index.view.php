<?php view("partials/head") ?>

<?php if ($_SESSION["id"] ?? false): ?>
    <?php view("partials/new_post_modal") ?>
<?php endif ?>


<!-- Posts -->
<?php foreach ($posts[''] as $post): ?>
    <?php view("partials/post_card", ['post' => $post]) ?>
    <!-- Post replies -->
    <?php if ($posts[$post['id']] ?? false): ?>
        <?php foreach (array_reverse($posts[$post['id']]) as $post_reply): ?>
            <?php view("partials/post_card", [
                'post' => $post_reply,
                'isReply' => true
            ]) ?>
        <?php endforeach; ?>
    <?php endif ?>
<?php endforeach; ?>

<?php view("partials/footer") ?>