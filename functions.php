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

function get_dt_range($date_string): array
{
    try {
        $difference = date_diff(new DateTime('now'), new DateTime($date_string), true);
        $hours = $difference->h + ($difference->d * 24);
        return [$hours, $difference->i];
    } catch (Exception $e) {
        //
    }
    return [0,0];
}
