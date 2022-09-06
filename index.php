<?php

/**
 * @var $categories - array() - Список категорий
 * @var $goods - array() - Список лотов
 * @var $is_auth - boolean - Признак авторизации
 * @var $user_name - string - Имя пользователя
 */

require_once 'helpers.php';
require_once 'functions.php';
require_once 'data.php';


$page_content = include_template('main.php', ['categories' => $categories, 'goods' => $goods]);
$layout_content = include_template('layout.php', ['is_auth' => $is_auth, 'user_name' => $user_name, 'content' => $page_content,
            'categories' => $categories, 'title' => 'Главная']);

print ($layout_content);

?>
