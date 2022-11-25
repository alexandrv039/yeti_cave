<?php
/**
 * @var $categories - array() - Список категорий
 * @var $lots - array() - Список лотов
 * @var $search - string - строка поиска
 * @var $page - int - Текущая страница
 * @var $countPages - int - Общее количество страниц
 */
?>

<nav class="nav">
    <ul class="nav__list container">
        <li class="nav__item">
            <a href="all-lots.html">Доски и лыжи</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Крепления</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Ботинки</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Одежда</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Инструменты</a>
        </li>
        <li class="nav__item">
            <a href="all-lots.html">Разное</a>
        </li>
    </ul>
</nav>
<div class="container">
    <section class="lots">
        <?php if (count($lots) > 0) : ?>
        <h2>Результаты поиска по запросу «<span><?= $search ?></span>»</h2>
        <?php else: ?>
        <h2>По запросу «<span><?= $search ?></span>» ничего не найдено</h2>
        <?php endif; ?>
        <ul class="lots__list">
            <?php foreach ($lots as $lot): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $lot['image'] ?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= $lot['category'] ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php<?= '?id=' . $lot['id'] ?>"><?= $lot['name'] ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= formatPrice($lot['price']) ?></span>
                        </div>
                        <?php
                        $timer = get_dt_range($lot['timer']);
                        $class_timer = '';
                        if ($timer[0] == 0) {
                            $class_timer = 'timer--finishing';
                        }
                        ?>
                        <div class="lot__timer timer <?= $class_timer ?>">
                            <?php

                            print ($timer[0] . ': ' . $timer[1]);

                            ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev">
            <a href="<?= $page > 1 ? 'search.php?page=' . $page - 1 . '&search=' . $search : '#' ?>">Назад</a>
        </li>
        <?php for ($i = 1; $i <= $countPages; $i++) : ?>
            <li class="pagination-item <?= $page == $i ? 'pagination-item-active' : '' ?>">
                <a href="<?='search.php?page=' . $i . '&search=' . $search?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <li class="pagination-item pagination-item-next">
            <a href="<?= $page < $countPages ? 'search.php?page=' . $page + 1 . '&search=' . $search : '#' ?>">Вперед</a>
        </li>
    </ul>
</div>
