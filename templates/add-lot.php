<?php
/**
 * @var $categories - array() - категории лотов
 * @var $lot -
 * @var $errors - array() - Массив ошибок заполнения формы пользователем
 */
?>

<form class="form form--add-lot container <?= (count($errors) > 0) ? 'form--invalid' : '' ?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?= array_key_exists('title', $errors) ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
            <label for="lot-name">Наименование <sup>*</sup></label>
            <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота">
            <span class="form__error"><?=  $errors['title'] ?></span>
        </div>
        <div class="form__item <?= (array_key_exists('category', $errors) ? 'form__item--invalid' : '') ?>">
            <label for="category">Категория <sup>*</sup></label>
            <select id="category" name="category">
            <option>Выберите категорию</option>
                <?php foreach ($categories as $category): ?>
                <option><?= $category['name_category'] ?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error"><?=  $errors['category'] ?></span>
        </div>
    </div>
    <div class="form__item form__item--wide <?= (array_key_exists('lot_description', $errors) ? 'form__item--invalid' : '') ?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите описание лота"></textarea>
        <span class="form__error"><?=  $errors['lot_description'] ?></span>
    </div>
    <div class="form__item form__item--file <?= (array_key_exists('img', $errors) ? 'form__item--invalid' : '') ?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot-img" name="lot-img" value="">
            <label for="lot-img">
                Добавить
            </label>
        </div>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?= (array_key_exists('start_price', $errors) ? 'form__item--invalid' : '') ?>">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" name="lot-rate" placeholder="0">
            <span class="form__error"><?=  $errors['start_price'] ?></span>
        </div>
        <div class="form__item form__item--small <?= (array_key_exists('step', $errors) ? 'form__item--invalid' : '') ?>">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" name="lot-step" placeholder="0">
            <span class="form__error"><?=  $errors['step'] ?></span>
        </div>
        <div class="form__item <?= (array_key_exists('date_finish', $errors) ? 'form__item--invalid' : '') ?>">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
            <span class="form__error"><?=  $errors['date_finish'] ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>
