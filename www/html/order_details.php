<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'orders.php';
require_once MODEL_PATH . 'order_details.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$order_id = get_get('order_id');

if(is_admin($user)){
    $order = get_order($db, $order_id);
    $order_details = get_order_details($db, $order_id);
} else{
    $order = get_users_order($db, $user['user_id'],$order_id);
    $order_details = get_users_order_details($db, $order_id, $user['user_id']);
}

include_once VIEW_PATH . 'orders_view.php';
