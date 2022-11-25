<?php

/**
 * @var $is_auth - boolean - Признак авторизации
 * @var $user_name - string - Имя пользователя
 * @var $con - Соединение с базой данных
 * @var $categories - array() - Список категорий
 */

require_once 'init.php';
require_once 'data.php';
require_once 'models.php';
require_once 'helpers.php';
require_once 'functions.php';

session_start();
$categories = getCategories($con);

$search = $_GET['search'];
$page = $_GET['page'] ?? 1;
$countLots = getCountLotsForSearch($con, $search);
$lots = getLotsBySearch($con, $search, $page);
$countPages = (int)ceil($countLots / 9);

$pageContent = include_template('search-template.php', [
    'lots' => $lots,
    'search' => $search,
    'page' => $page,
    'countPages' => $countPages,
    ]);
$layoutContent = include_template('layout.php', ['content' => $pageContent, 'categories' => $categories,
    'title' => 'Результат поиска']);
print $layoutContent;
