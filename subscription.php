<!-- 定期購入処理 -->
<?php

const SERVER = 'mysql213.phy.lolipop.lan';
const DBNAME = 'LAA1517338-sample';
const USER = 'LAA1517338';
const PASS = 'Pass0216';
$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';


$pdo = new PDO($connect, USER, PASS);


    // 定期購入テーブルの(next_order_date)今日または過去のレコードを取得(CURDATE()関数で実現)
    $query = "SELECT * FROM subscription_orders WHERE next_order_date <= CURDATE()";
    $stmt = $pdo->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // 商品とユーザーと購入感覚の情報を取得
        $user_id = $row['user_id'];
        $product_id = $row['product_id'];
        $interval_days = $row['interval_days'];

        // 商品テーブルから情報を取得し在庫確認
        $productSql = "SELECT * FROM Products WHERE product_id = ?";
        $productsStmt = $pdo->prepare($productSql);
        $productsStmt->execute([$product_id]);
        // 在庫を変数に格納
        // $product_quantity;
        // foreach($productsStmt as $product){
        //     $product_quantity = $product['quantity'];
        // }
        // 在庫が足りているかの確認、足りていなければcontinueさせるif文を追加予定　そもそもこのファイルうまくいくのかを確認してから
        // if($product_quantity <= 0){
        //     continue;
        // }

        
        // 購入処理（購入テーブルと購入詳細テーブルに内容を挿入）
        // 購入テーブルにインサート文の実行

        $Date = date('Y-m-d H:i:s');
        $pdo->beginTransaction();
        $orderSql = "INSERT INTO Orders (user_id, date) VALUES (?, ?)";
        $orderSql = $pdo->prepare($orderSql);
        $orderSql->execute([$user_id, $Date]);

        // その次は購入詳細にデータ挿入

        $orderDetailSql = "INSERT INTO OrdersDetails (order_id, product_id,quantity) VALUES (LAST_INSERT_ID(), ?,?)";
        $orderDetailSql = $pdo->prepare($orderDetailSql);
        $orderDetailSql->execute([$product_id,1]);

        $pdo->commit();

        // 次回の購入予定日を更新 DATE_ADD関数　使用例　⇨ DATE_ADD('2023-01-01', INTERVAL 10 DAY)　＝＞10日後の値に更新するらしい。。すごい
        $updateSql = "UPDATE subscription_orders SET next_order_date = DATE_ADD(next_order_date, INTERVAL ? DAY) WHERE subscription_id = ?";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([$interval_days, $row['subscription_id']]);
    }
$pdo = null;
?>
