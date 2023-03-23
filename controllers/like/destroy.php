<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query(
	'DELETE FROM likes WHERE user_id =:user_id AND post_id =:post_id',
	[
		'user_id' => $_SESSION['id'],
		'post_id' => $_POST['id']
	]
);

header('Location: /');
exit();
