<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$stmt = 'SELECT 
            posts.id, 
            posts.body, 
            posts.likes, 
            users.username AS author_username
         FROM posts
         JOIN users
         ON posts.author_id = users.id
         ORDER BY posts.id DESC';

$posts = $db->query($stmt)->fetchAll();

view('posts/index', compact('posts'));
