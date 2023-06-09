<?php

use Core\Paginator;

$post = getPost($_GET['id']);

authorize($_SESSION['id'] === $post['author_id']);

$user_id = $_SESSION['id'] ?? null;
$page = $_GET['page'] ?? null;
$per_page = 4;
$pages_total = getPages($per_page);

if ($page < 1 || $page > $pages_total) {
    $_GET['page'] = 1;
    redirect('/?' . http_build_query($_GET));
}

$posts = getPosts($user_id, $page, $per_page);
$post_ids = array_map(fn($post) => $post['id'], $posts);
$replies = getReplies($post_ids, $user_id);


view(
    'index',
    [
        'posts' => $posts,
        'replies' => $replies,
        'post_to_edit' => $post,
        'prevPageUrl' => Paginator::getPrevPageUrl($_GET),
        'nextPageUrl' => Paginator::getNextPageUrl($_GET, $pages_total)
    ]
);