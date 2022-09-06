<?php
/**
 * Форматирует цену и возвращает ее в виде строки со знаком ₽ на конце
 * @param float|int $price - изначальная цена
 * @return string - форматированная строка
 */
function formatPrice(float|int $price): string
{
    ceil($price);
    $price = number_format($price, 0, '', ' ') . ' ₽';
    return $price  . ' ₽';
}
