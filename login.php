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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userDB = null;
    if (empty($_POST['email'])) {
        $errors['email'] = 'Необходимо указать адрес электронной почты';
    } else {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $errors['email'] = 'Необходимо указать корректный адрес электронной почты';
        } else {
            $userDB = getUserByEmail($con, $email);
            if ($userDB == null) {
                $errors['email'] = 'Пользователь не зарегистрирован';
            }
        }
        $userData['email'] = $email;
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Не указан пароль';
    } else {
        $userData['password'] = $_POST['password'];
    }
    if ($userDB <> null) {
        if (!password_verify($_POST['password'], $userDB['user_password'])) {
            $errors['password'] = 'Неверный пароль';
        }
    }

}
if (count($errors) == 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['user_name'] = $userDB['user_name'];
    $_SESSION['user_id'] = $userDB['id'];
    header('Location: index.php');
} else {
    $pageContent = include_template('login-template.php', ['userData' => $userData, 'errors' => $errors]);
    $layoutContent = include_template('layout.php', ['content' => $pageContent, 'categories' => $categories,
        'title' => 'Регистрация на сайте']);
    print $layoutContent;
}
