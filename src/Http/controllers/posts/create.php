<?php

use Core\App;
use Core\Paginator;
use Core\Post;
use Doctrine\ORM\EntityManager;

$per_page = 4;
$page = $_GET['page'] ?? null;
$user_id = $_SESSION['id'] ?? null;
$reply_to = $_GET['parent_id'] ?? null;

/** @var EntityManager $entityManager */
$entityManager = App::resolve(EntityManager::class);

$pages_total = $entityManager->getRepository(Post::class)->getTotalPages($per_page);

validatePageNumber($page, $pages_total, $_GET);

$posts = $entityManager->getRepository(Post::class)->getLatestPostsPaginator($page, $per_page);

$prevPageUrl = Paginator::getPrevPageUrl($_GET);
$nextPageUrl = Paginator::getNextPageUrl($_GET, $pages_total);

view(
    'index',
    compact(['posts', 'page', 'reply_to', 'user_id', 'prevPageUrl', 'nextPageUrl'])
);
