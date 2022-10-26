<?php
/**
 * @var $is_auth - boolean - Признак авторизации
 * @var $user_name - string - Имя пользователя
 * @var $con - Соединение с базой данных
 */

require_once 'init.php';
require_once 'data.php';
require_once 'models.php';
require_once 'helpers.php';
require_once 'functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($id) {
    $lot = getLot($con, $id);
    $categories = getCategories($con);
    $page_content = include_template('lot_template.php', ['lot' => $lot]);
    $layout_content = include_template('layout.php', ['is_auth' => $is_auth, 'user_name' => $user_name, 'content' => $page_content,
        'title' => $lot['title'], 'categories' => $categories]);

    print ($layout_content);
} else {
    http_response_code(404);
    die();
}


