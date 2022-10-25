<?php

function getCategories($con)
{
    $categories = [];
    if (!$con) {
        $error = mysqli_connect_error();
    } else {
        $sql = "SELECT character_code, name_category FROM yeti_cave.categories";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
    return $categories;
}

function getLot($con, $id)
{
    if (!$con) {
        $error = mysqli_connect_error();
    } else {
        $sql = get_query_lot_by_id($id);
        $result = mysqli_query($con, $sql);
        if ($result) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
        }
    }
    return null;
}

function getGoods($con)
{
    $goods = [];
    $sql_goods = get_query_list_lots('2022-09-01');
    $result = mysqli_query($con, $sql_goods);
    if ($result) {
        $goods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }
    return $goods;
}

function get_query_list_lots($date_end)
{
    $sql = "SELECT lots.id              as id,
       title           as name,
       c.name_category as category,
       start_price     as price,
       img             as image,
       date_finish     as timer
FROM yeti_cave.lots as lots
         LEFT JOIN yeti_cave.categories as c ON lots.category_id = c.id
WHERE lots.date_finish > $date_end ORDER BY date_create DESC";
    return $sql;
}

function get_query_lot_by_id($id)
{
    $sql = "SELECT lots.id              as id,
       title           as title,
       start_price     as price,
       img             as image,
       date_finish     as timer,
       c.name_category as category,
       lot_description as lot_description
        FROM yeti_cave.lots as lots
            LEFT JOIN yeti_cave.categories as c ON lots.category_id = c.id
        WHERE lots.id = $id";
    return $sql;
}
