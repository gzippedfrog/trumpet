<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query(
    'INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)',
    [
        'user_id' => $_SESSION['id'],
        'post_id' => $_POST['id']
    ]
);

header('Location: /');
exit();
