<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_orders($db, $user_id){
    $sql = "
        SELECT
            orders.order_id,
            orders.created,
            SUM(price * amount) as total
        FROM
            orders
        JOIN
            order_details
        ON
            orders.order_id = order_details.order_id
        WHERE
            user_id = ?
        GROUP BY
            orders.order_id
        ORDER BY
            orders.created desc
    ";
    return fetch_all_query($db, $sql, [$user_id]);
}
function get_all_orders($db){
    $sql = "
        SELECT
            orders.order_id,
            orders.created,
            SUM(price * amount) as total
        FROM
            orders
        JOIN
            order_details
        ON
            orders.order_id = order_details.order_id
        GROUP BY
            orders.order_id
            ORDER BY
            orders.created desc
    ";
    return fetch_all_query($db, $sql);
}

function get_users_order($db, $user_id, $order_id){
    $sql = "
        SELECT
            orders.order_id,
            orders.created,
            SUM(price * amount) as total
        FROM
            orders
        JOIN
            order_details
        ON
            orders.order_id = order_details.order_id
        WHERE
            user_id = ?
        AND
            orders.order_id = ?
            GROUP BY
            orders.order_id
    ";
    return fetch_query($db, $sql, [$user_id, $order_id]);
}

function get_order($db, $order_id){
    $sql = "
        SELECT
            orders.order_id,
            orders.created,
            SUM(price * amount) as total
        FROM
            orders
        JOIN
            order_details
        ON
            orders.order_id = order_details.order_id
        WHERE
            orders.order_id = ?
            GROUP BY
            orders.order_id
    ";
    return fetch_query($db, $sql, [$order_id]);
}

function insert_orders($db, $user_id) {
    $sql = "
      INSERT INTO
        orders(
          user_id,
          created
        )
      VALUES(?,now())
    ";
  
    return execute_query($db, $sql, [$user_id]);
}


