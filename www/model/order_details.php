<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_order_details($db, $order_id){
    $sql = "
        SELECT
            name,
            order_details.price,
            amount,
        order_details.price * amount as subtotal
        FROM
            order_details
        JOIN
            items
        ON
            order_details.item_id = items.item_id
        WHERE
            order_id = ?
    ";
    return fetch_all_query($db, $sql, [$order_id]);
}

function get_users_order_details($db, $order_id, $user_id){
    $sql = "
        SELECT
            name,
            order_details.price,
            amount,
        order_details.price * amount as subtotal
        FROM
            order_details
        JOIN
            items
        ON
            order_details.item_id = items.item_id
        JOIN
            orders
        ON
            order_details.order_id = orders.order_id
        WHERE
            orders.order_id = ?
        AND
            user_id = ?
    ";
    return fetch_all_query($db, $sql, [$order_id, $user_id]);
}


function insert_order_details($db, $order_id, $item_id, $price, $amount) {
    $sql = "
      INSERT INTO
        order_details(
          order_id,
          item_id,
          price,
          amount,
          created
        )
      VALUES(?, ?, ?, ?,now())
    ";
  
    return execute_query($db, $sql, [$order_id, $item_id, $price, $amount]);
  }