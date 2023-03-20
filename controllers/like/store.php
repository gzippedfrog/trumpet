<?php

use Core\App;
use Core\Database;

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO likes (user_id, post_id)
         VALUES (:user_id, :post_id)';

$db->query($stmt, compact('user_id', 'post_id'));

header('Location: /');
exit();
