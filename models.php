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

function getGoods($con)
{
    $goods = [];
    $sql_goods = get_query_list_lots(date("Y-m-d"));
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
    $sql = "SELECT
    title as name,
    c.name_category as category,
    start_price as price,
    img as image,
    date_finish as timer
FROM yeti_cave.lots LEFT JOIN yeti_cave.categories as c ON lots.category_id = c.id
WHERE lots.date_finish > $date_end";
    return $sql;
}
