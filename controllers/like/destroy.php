<?php

use Core\App;
use Core\Database;

$user_id = $_POST['user_id'];
$post_id = $_POST['post_id'];

$db = App::resolve(Database::class);

$stmt = 'DELETE
FROM
	likes
WHERE
	user_id =:user_id
	AND post_id =:post_id';

$db->query($stmt, compact('user_id', 'post_id'));

header('Location: /');
exit();
