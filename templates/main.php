
<?php
/**
 * @var $categories - array() - Список категорий
 * @var $goods - array() - Список лотов
 */
?>

<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и
        горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories as $category): ?>
            <li class="promo__item promo__item--<?= $category['character_code'] ?>">
                <a class="promo__link" href="pages/all-lots.html"><?= $category['name_category'] ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($goods as $lot): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?= $lot['image'] ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= $lot['category'] ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= $lot['name'] ?></a>
                    </h3>
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
