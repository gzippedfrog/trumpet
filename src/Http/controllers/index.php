<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$stmt = "SELECT
   posts.parent_id,
   posts.id,
   posts.text,
   posts.author_id AS author_id,
   users.username AS author_username,
   COUNT(likes.user_id) AS likes,
   SUM(likes.user_id=:user_id) AS liked
FROM posts
JOIN users ON users.id = posts.author_id
LEFT JOIN likes ON likes.post_id = posts.id
GROUP BY posts.id
ORDER BY posts.id DESC";

$posts = $db->query(
   $stmt,
   ['user_id' => array_key_exists('id', $_SESSION) ? $_SESSION['id'] : null]
)->fetchAll(PDO::FETCH_GROUP);

view('index', compact('posts'));
