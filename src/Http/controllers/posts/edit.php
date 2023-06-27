<?php

use Core\App;
use Core\Paginator;
use Core\Post;
use Doctrine\ORM\EntityManager;

$per_page = 4;
$page = $_GET['page'] ?? null;
$user_id = $_SESSION['id'] ?? null;
$edit_id = $_GET['id'] ?? null;

/** @var EntityManager $entityManager */
$entityManager = App::resolve(EntityManager::class);

$post_to_edit = $entityManager->find(Post::class, $edit_id);

authorize($user_id === $post_to_edit->author->id);

$pages_total = $entityManager->getRepository(Post::class)->getTotalPages($per_page);

validatePageNumber($page, $pages_total, $_GET);

$posts = $entityManager->getRepository(Post::class)->getLatestPostsPaginator($page, $per_page);

$prevPageUrl = Paginator::getPrevPageUrl($_GET);
$nextPageUrl = Paginator::getNextPageUrl($_GET, $pages_total);

view(
    'index',
    compact(['posts', 'post_to_edit', 'page', 'user_id', 'prevPageUrl', 'nextPageUrl'])
);
