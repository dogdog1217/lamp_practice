<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'orders.css'); ?>">
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入履歴</h1>
    <div class="container">

        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <?php if(count($orders) > 0){ ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>注文番号</th>
                        <th>購入日時</th>
                        <th>合計金額</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order){ ?>
                        <tr>    
                            <td><?php print(h($order['order_id'])) ?></td>
                            <td><?php print(h($order['created'])) ?></td>
                            <td><?php print number_format(h($order['total'])); ?>円</td>
                            <td>
                                <form action="<?php print ORDER_DETAILS_URL ?>">
                                <input type="submit" value="購入明細">
                                <input type="hidden" name="order_id" value="<?php print h($order['order_id'])?>">
                                </form>
                            </td>
                        </tr>    
                    <?php } ?>        
                </tbody>
            </table>
        <?php } ?>
    </div>
</body>
</html>