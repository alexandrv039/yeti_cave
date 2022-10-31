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

$categories = getCategories($con);
$errors = [];
$lot = [
    'title' => '',
    'lot_description' => '',
    'img' => '',
    'start_price' => '',
    'date_finish' => '',
    'category' => '',
    'step' => 0
];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot['title'] = !empty($_POST['lot-name']) ? $_POST['lot-name'] : '';
    if (empty($lot['title'])) {
        $errors['title'] = 'Необходимо заполнить наименование';
    }
    $category = !empty($_POST['category']) ? $_POST['category'] : '';
    $categoryExist = false;
    for ($i = 0; $i < count($categories); $i++){
        $cat = $categories[$i];
        if ($cat['name_category'] == $category) {
            $categoryExist = true;
            $lot['category'] = $cat['name_category'];
            break;
        }
    }
    if (empty($category) || !$categoryExist) {
        $errors['category'] = 'Необходимо выбрать категорию';
    }

    $lot['lot_description'] = !empty($_POST['message']) ? $_POST['message'] : '';
    if (empty(['lot_description'])) {
        $errors['lot_description'] = 'Необходимо заполнить описание лота';
    }

    if (isset($_FILES['lot-img'])) {
        if (mime_content_type($_FILES['lot-img']['tmp_name']) == 'image/png' ||
            mime_content_type($_FILES['lot-img']['tmp_name']) == 'image/jpeg') {
            $fileName = $_FILES['lot-img']['name'];
            $filePath = __DIR__ . '/uploads/' . $fileName;
            move_uploaded_file($_FILES['lot-img']['tmp_name'], $filePath);
            $lot['img'] = $filePath;
        } else {
            $errors['img'] = 'Можно добавлять только файлы формата png или jpeg';
        }
    } else {
        $errors['img'] = 'Необходимо добавить изображение лота';
    }

    if (isset($_POST['lot-rate']) && !empty($_POST['lot-rate'])) {
        $lot['start_price'] = $_POST['lot-rate'];
    } else {
        $errors['start_price'] = 'Необходимо указать начальную цену';
    }

    if (isset($_POST['lot-date']) && !empty($_POST['lot-rate'])) {
        if (is_date_valid($_POST['lot-date'])) {
            $lot['date_finish'] = $_POST['lot-rate'];
        } else {
            $errors['date_finish'] = 'Необходимо указать дату в правильном формате';
        }
    } else {
        $errors['date_finish'] = 'Необходимо указать дату завершения';
    }

    if (isset($_POST['lot-step']) && !empty($_POST['lot-step'])) {
        $lot['step'] = $_POST['lot-step'];
    } else {
        $errors['step'] = 'Необходимо указать шаг аукциона';
    }

    if (count($errors) == 0) {
        header('Location: index.php');
    }
}
$page_content = include_template('add-lot.php', ['categories' => $categories]);
$layout_content = include_template('layout.php', ['is_auth' => $is_auth, 'user_name' => $user_name, 'content' => $page_content,
    'title' => 'Новый лот', 'categories' => $categories]);

print ($layout_content);
