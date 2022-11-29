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
$userData = [
    'email' => '',
    'password' => '',
    'name' => '',
    'contacts' => ''
];
$errors = [];
$categories = getCategories($con);

$goods = getGoods($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Необходимо указать адрес электронной почты';
    } else {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $errors['email'] = 'Необходимо указать корректный адрес электронной почты';
        } else {
            $userDB = getUserByEmail($con, $email);
            if ($userDB <> null) {
                $errors['email'] = 'Пользователь уже зарегистрирован';
            }
        }
        $userData['email'] = $email;
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Необходимо указать пароль';
    } else {
        $userData['password'] = $_POST['password'];
    }

    if (empty($_POST['name'])) {
        $errors['name'] = 'Необходимо указать имя пользователя';
    } else {
        $userData['name'] = $_POST['name'];
    }

    if (empty($_POST['message'])) {
        $errors['contacts'] = 'Не заполнены контактные данные';
    } else {
        $userData['contacts'] = $_POST['message'];
    }

    if (count($errors) == 0) {
        saveUser($con, $userData);
        header('Location: index.php');
    }
}

$pageContent = include_template('sing-up-template.php', ['userData' => $userData, 'errors' => $errors]);
$layoutContent = include_template('layout.php', ['content' => $pageContent, 'categories' => $categories,
            'title' => 'Регистрация на сайте']);
print $layoutContent;
