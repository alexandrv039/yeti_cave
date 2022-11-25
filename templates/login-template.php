<?php
/**
 * @var $userData - array() - категории лотов
 * @var $errors - array() - Массив с ошибками заполнения
 */
?>

<form class="form container <?= count($errors) > 0 ? 'form--invalid' : '' ?>" action="login.php" method="post">
    <h2>Вход</h2>
    <div class="form__item <?= array_key_exists('email', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $userData['email'] ?>">
        <span class="form__error"><?= array_key_exists('email', $errors) ? $errors['email'] : '' ?></span>
    </div>
    <div class="form__item form__item--last <?= array_key_exists('password', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?= $userData['password'] ?>">
        <span class="form__error"><?= array_key_exists('password', $errors) ? $errors['password'] : '' ?></span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>
