<?php

function getCategories($con)
{
    $categories = [];
    if (!$con) {
        $error = mysqli_connect_error();
    } else {
        $sql = "SELECT id, character_code, name_category FROM yeti_cave.categories";
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

function saveLot($con, $lot)
{
        $sql = "INSERT INTO yeti_cave.lots (title, lot_description, img, start_price, date_finish, step, user_id, category_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt === false) {
            $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($con);
            die($errorMsg);
        }

        if ($lot) {
            $types = '';
            $stmt_data = [];

            foreach ($lot as $value) {
                $type = 's';

                if (is_int($value)) {
                    $type = 'i';
                }
                else if (is_string($value)) {
                    $type = 's';
                }
                else if (is_double($value)) {
                    $type = 'd';
                }

                if ($type) {
                    $types .= $type;
                    $stmt_data[] = $value;
                }
            }

            $values = array_merge([$stmt, $types], $stmt_data);
            mysqli_stmt_bind_param(...$values);

            if (mysqli_errno($con) > 0) {
                $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($con);
                die($errorMsg);
            }
        }

        return $stmt->execute();
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

function getCountLotsForSearch($con, $search)
{
    $countPages = 0;
    $sqlCount = "SELECT count(*) as countPages
                FROM yeti_cave.lots as lots
                         LEFT JOIN yeti_cave.categories as c ON lots.category_id = c.id
                WHERE MATCH(title, lot_description) AGAINST('$search')";
    $resultCount = mysqli_query($con, $sqlCount);
    if ($resultCount) {
        $countPages = (int)mysqli_fetch_object($resultCount)->countPages;
    } else {
        $error = mysqli_error($con);
    }
    return $countPages;
}

function getLotsBySearch($con, $search, $page)
{
    $lots = [];
    $offset = ($page - 1) * 9;

    $sql = "SELECT lots.id     as id,
               title           as name,
               c.name_category as category,
               start_price     as price,
               img             as image,
               date_finish     as timer
            FROM yeti_cave.lots as lots
                 LEFT JOIN yeti_cave.categories as c ON lots.category_id = c.id
            WHERE MATCH(title, lot_description) AGAINST('$search')
            ORDER BY date_create DESC
            LIMIT 9 OFFSET $offset";

    $result = mysqli_query($con, $sql);
    if ($result) {
        $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
    }

    return $lots;
}

function getUserByEmail($con, $email)
{
    $user = [];
    $sql = "SELECT *
            FROM yeti_cave.users
            WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if (count($users) == 0) {
            return null;
        }
        $user = $users[0];
    } else {
        $error = mysqli_error($con);
    }
    return $user;
}

function saveUser($con, $userData)
{
    $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO yeti_cave.users (email, user_password, user_name, contacts)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($con);
        die($errorMsg);
    }

    if ($userData) {
        $types = '';
        $stmt_data = [];

        foreach ($userData as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            }
            else if (is_string($value)) {
                $type = 's';
            }
            else if (is_double($value)) {
                $type = 'd';
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);
        mysqli_stmt_bind_param(...$values);

        if (mysqli_errno($con) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($con);
            die($errorMsg);
        }
    }

    return $stmt->execute();
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
