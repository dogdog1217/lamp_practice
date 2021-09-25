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

        <?php if($order !== false){ ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>注文番号</th>
                        <th>購入日時</th>
                        <th>合計金額</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>    
                            <td><?php print(h($order['order_id'])) ?></td>
                            <td><?php print(h($order['created'])) ?></td>
                            <td><?php print number_format(h($order['total'])); ?>円</td>
                        </tr>        
                </tbody>
            </table>
        <?php } else{?>
            <p>該当する明細は見つかりませんでした。</p>
        <?php } ?>
        <?php if(count($order_details) > 0){ ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>商品名</th>
                        <th>購入価格</th>
                        <th>購入数</th>
                        <th>小計</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($order_details as $detail){ ?>
                        <tr>    
                            <td><?php print(h($detail['name'])) ?></td>
                            <td><?php print(number_format(h($detail['price']))) ?></td>
                            <td><?php print(h($detail['amount'])) ?></td>
                            <td><?php print number_format(h($detail['subtotal'])); ?>円</td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php }?>
    </div>
</body>
</html>