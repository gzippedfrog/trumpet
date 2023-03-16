<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$stmt = 'SELECT 
            posts.id, 
            posts.text, 
            users.username AS author_username,
            COUNT(likes.post_id) AS likes
         FROM posts
         JOIN users
         ON posts.author_id = users.id
         LEFT JOIN likes
         ON posts.id = likes.post_id
         GROUP BY posts.id
         ORDER BY posts.id DESC';

$posts = $db->query($stmt)->fetchAll();

view('posts/index', compact('posts'));
