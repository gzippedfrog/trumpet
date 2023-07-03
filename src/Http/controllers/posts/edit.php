<?php

use Core\App;
use Core\Paginator;
use Core\Post;
use Doctrine\ORM\EntityManager;

$user_id = isset($_SESSION['id']) ? (int)$_SESSION['id'] : null;
$edit_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$page = isset($_GET['page']) ? (int)$_GET['page'] : null;
$per_page = 4;

$entityManager = App::resolve(EntityManager::class);

$post = $entityManager->find(Post::class, $edit_id);

authorize($user_id === $post->getAuthor()->getId());

$pages_total = $entityManager->getRepository(Post::class)->getTotalPages($per_page);

validatePageNumber($page, $pages_total, $_GET);

$posts = $entityManager->getRepository(Post::class)->getLatestPostsPaginator($page, $per_page);

view(
    'index',
    [
        'posts' => $posts,
        'post_to_edit' => $post,
        'page' => $page,
        'user_id' => $user_id,
        'prevPageUrl' => Paginator::getPrevPageUrl($_GET),
        'nextPageUrl' => Paginator::getNextPageUrl($_GET, $pages_total)
    ]
);
