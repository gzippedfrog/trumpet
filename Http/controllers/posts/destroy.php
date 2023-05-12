<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$post = $db->query(
    'SELECT * from posts where id = :id',
    ['id' => $_POST['id']]
)->fetch();

if ($post['author_id'] === $_SESSION['id']) {
    $db->query(
        'DELETE FROM posts where id = :id',
        ['id' => $_POST['id']]
    );
}

header('Location: /');
exit();
