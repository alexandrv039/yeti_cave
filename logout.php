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
$_SESSION = [];
header('Location: index.php');
