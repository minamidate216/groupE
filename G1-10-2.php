<?php require 'header.php'; ?>

<?php
$pdo = new PDO($connect, USER, PASS);

if (!empty($_POST['productCount'])) {
    $productCounts = $_POST['productCount'];
    $productIds = $_POST['productId'];
    $productNames = $_POST['productName'];
    $productPrices = $_POST['productPrice'];
    $productImages = $_POST['productImage'];

    $orderPlaced = false;

    // 注文個数が1個以上あるかどうかチェック
    foreach ($productCounts as $count) {
        if ($count > 0) {
            $orderPlaced = true;
            break;
        }
    }
    // 一個以上ならまず注文テーブルにデータを挿入
    if ($orderPlaced) {
        // Ordersテーブルに注文を挿入
        $userId = $_SESSION['Users']['user_id'];
        $currentDateTime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO Orders (user_id, date) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId, $currentDateTime]);
        // 注文が上手くいっていれば注文idを取得して、注文詳細のデータ挿入もしちゃう
        if ($stmt) {
            $orderId = $pdo->lastInsertId();

            // 各商品の注文詳細をOrdersDetailsテーブルに挿入
            foreach ($productIds as $id => $productId) {
                $count = $productCounts[$id];
                if ($count > 0) {
                    $detailSql = "INSERT INTO OrdersDetails (order_id, product_id, quantity) VALUES (?, ?, ?)";
                    $detailStmt = $pdo->prepare($detailSql);
                    $detailStmt->execute([$orderId, $productId, $count]);

                    if ($detailStmt) {
                        // 在庫を減らす処理
                        $updateStockSql = "UPDATE Products SET quantity = quantity - ? WHERE product_id = ?";
                        $updateStockStmt = $pdo->prepare($updateStockSql);
                        $updateStockStmt->execute([$count, $productId]);
                    }
                } else {
                    echo '<p class="has-text-center help" >商品名：' . $productNames[$id] . 'の注文はキャンセルしました。</p><br>';
                }
            }

            // 注文履歴画面のsqlを引用　全ユーザーの履歴ではなく個人が今回購入した内容を表示するように変更
            // 注文日、ユーザーネーム、注文番号、注文詳細番号、商品名、商品画像、価格,個数
            $query = $pdo->prepare("
                SELECT O.order_id, OD.orderdetail_id, OD.quantity, O.date, OD.product_id, U.user_name, P.price, P.product_name, P.product_img
                FROM Orders O 
                JOIN OrdersDetails OD ON O.order_id = OD.order_id
                JOIN Products P ON OD.product_id = P.product_id 
                JOIN Users U ON O.user_id = U.user_id 
                WHERE 
                    O.user_id = ? AND O.order_id = ?
                ORDER BY O.order_id
                ");
            $query->execute([$userId, $orderId]);
            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            // 注文IDごとにデータを整理
            $orders = [];
            foreach ($results as $row) {
                $order_id = $row['order_id'];
                if (!isset($orders[$order_id])) {
                    $orders[$order_id] = [
                        'date' => $row['date'],
                        'name' => $row['user_name'],
                        'details' => [],
                        'total' => 0
                    ];
                }
                $orders[$order_id]['details'][] = $row;
                $orders[$order_id]['total'] += $row['quantity'] * $row['price'];
            }

            foreach ($orders as $order_id => $order) {
                echo '<div class="content">';
                echo '<div class="container">';
                echo '<div class="card" style="width:100%;">';
                echo '<header class="card-header has-background-warning-light">';
                echo '<span class="card-header-title"><i class="far fa-calendar-alt"></i>注文日: ' . $order['date'] . '</span>';
                echo '<span class="card-header-title"><i class="fas fa-sort-numeric-down"></i>注文番号: ' . $order_id . '</span>';
                echo '</header>';
                echo '<div class="card-content">';
                echo '<div class="columns is-multiline">';  // カラムの開始

                foreach ($order['details'] as $detail) {
                    // 各商品の詳細をカラムで表示
                    echo '<div class="column is-one-third">';  // カラムを定義
                    echo '<div class="content">';
                    echo '<img src="image/' . $detail['product_img'] . '" style="width:130px;">';
                    echo '<p class="subtitle">' . $detail['product_name'] . '</p>';
                    echo '<p>単価: ¥' . $detail['price'] . '</p>';
                    echo '<p>数量: ' . $detail['quantity'] . '</p>';  // 数量を表示
                    echo '</div>';
                    echo '</div>';  // カラムの終了
                }

                echo '</div>';  // カラムの終了
                echo '<footer class="card-footer has-background-warning-light">';
                echo '<span class="card-footer-item"><i class="fas fa-wallet"></i>合計金額: ' . $order['total'] .
                    '円&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fab fa-qq"></i>注文者: ' . $order['name'] . '</span>';
                echo '</footer>';
                echo '</div>';
                echo '</div>';
                echo '<h3>' . $_SESSION['Users']['user_name'] . 'さん、ご購入ありがとうございます</h3>';
                echo '<a class="button is-success is-outlined is-medium" href="G1-1-1.php">サイトトップへ</a>';
                echo '</div>';
                echo '</div>';

                unset($_SESSION['product']);
            }

        } else {
            echo "注文の処理に失敗しました。";
        }

    } else {
        echo "注文がありません。";
    }
} else {
    echo "注文データがありません。";
}


require 'footer.php'; ?>