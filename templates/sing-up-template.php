<?php
/**
 * @var $userData - array() - категории лотов
 * @var $errors - array() - Массив с ошибками заполнения
 * @var $userData - array() - Данные пользователя
 */
?>

<form class="form container <?= (count($errors) > 0 ? 'form--invalid' : '') ?>" action="sing-up.php" method="post" autocomplete="off"> <!-- form
    --invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?= (array_key_exists('email', $errors) ? 'form__item--invalid' : '') ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $userData['email'] ?>">
        <span class="form__error"><?= (array_key_exists('email',  $errors) ? $errors['email'] : '') ?></span>
    </div>
    <div class="form__item <?= (array_key_exists('password',  $errors) ? 'form__item--invalid' : '') ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?= $userData['password'] ?>">
        <span class="form__error"><?= (array_key_exists('password',  $errors) ? $errors['password'] : '') ?></span>
    </div>
    <div class="form__item <?= (array_key_exists('name',  $errors) ? 'form__item--invalid' : '') ?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= $userData['name'] ?>">
        <span class="form__error"><?= (array_key_exists('name',  $errors) ? $errors['name'] : '') ?></span>
    </div>
    <div class="form__item <?= (array_key_exists('contacts',  $errors) ? 'form__item--invalid' : '') ?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?= $userData['contacts'] ?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
