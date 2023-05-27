<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$post = $db->query(
    'SELECT * FROM posts WHERE id = :post_id',
    ['post_id' => $_GET['id']]
)->fetch();

authorize($_SESSION['id'] === $post['author_id']);

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
    ['user_id' => $_SESSION['id'] ?? null]
)->fetchAll(PDO::FETCH_GROUP);

view(
    'index',
    [
        'posts' => $posts,
        'post' => $post
    ]
);