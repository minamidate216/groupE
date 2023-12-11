<?php require 'header.php'; ?>
<?php
$pdo = new PDO($connect, USER, PASS);
// セッションに保存されている商品idの取得
$productIds = array_keys($_SESSION['product']);
// insert文（理想としては処理が上手くいったらこのページを表示させたい今はsqlの実行とセッションからのカート情報を同じファイルにしてまう）
// Ordersテーブル
// セッションからユーザーIDを取得
$userId = $_SESSION['Users']['user_id'];
// 現在の日時の取得
$currentDateTime = date('Y-m-d H:i:s');
// sql文のセット
$sql = "INSERT INTO Orders (user_id, date) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
// SQL文を実行
$stmt->execute([$userId, $currentDateTime]);
// 成功したかどうかをチェック
if ($stmt) {
    // 新しく挿入された注文のIDを取得
    $orderId = $pdo->lastInsertId();
    // echo '<h2>ご購入が完了しました。</h2>';
    // echo '<p>注文ID: ' . $orderId . '</p>';
} else {
    echo "注文に失敗しました。";
    '<a href="G1-10-1.php">購入確認画面に戻る</a>';
}
// orderテーブルここまで

// 前ページの$_postを受け取る
    // 商品の情報を含む配列を初期化
    $products = array();

    // productIdの各キーに対してループ
    foreach ($_POST['productId'] as $id => $productId) {
        // 各商品の情報を配列に格納
        $products[] = array(
            'id' => $productId,
            'name' => $_POST['productName'][$id],
            'count' => $_POST['productCount'][$id],
            'image' => $_POST['productImage'][$id],
            'price' => $_POST['productPrice'][$id]
        );
    }
// 商品テーブルの在庫を減らす
foreach ($products as $product){    
    $quantity = $product['count']; // カートの商品の数量
    $stmt = $pdo->prepare("UPDATE Products SET quantity = quantity - ? WHERE product_id = ?");
    // クエリを実行します。
    $stmt->execute([$quantity, $product['id']]);
}


// OrdersDetailsテーブル
// 注文詳細をOrdersDetailsテーブルに挿入
foreach ($products as $product) {
    $quantity = $product['count']; // カートの商品の数量
    $detailSql = "INSERT INTO OrdersDetails (order_id, product_id, quantity) VALUES (?, ?, ?)";
    $detailStmt = $pdo->prepare($detailSql);
    $detailStmt->execute([$orderId, $product['id'], $quantity]);
}
// insert文はここまで
if ($detailStmt) {

// ＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿＿
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
$query->execute([$userId,$orderId]);
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
    echo '<div style="display: flex; flex-wrap: wrap";>';
    echo '<div class="card" style="width:100%";>';
    echo '<header class="card-header has-background-warning-light">';
    echo '<span class="card-header-title"><i class="far fa-calendar-alt"></i>注文日:' . $order['date'] . '</span>';
    echo '<span class="card-header-title"><i class="fas fa-sort-numeric-down"></i>注文番号:' . $order_id . '</span>';
    echo '</header>';
    echo '<div class="card-content>';
    foreach ($order['details'] as $detail) {
        // 各商品の詳細を表示
        echo '<div class="content">';
        echo '<img  src= "image/', $detail['product_img'], '" style="width:130px";>';
        echo "<span><h2>" . $detail['product_name'] . "</h2></span>";
        echo "<span><h2>単価: ¥" . $detail['price'] . "</h2></span>";
        echo "</div><hr>";    
    }
    echo '<footer class="card-footer has-background-warning-light">';
    echo '<span class="card-footer-item"><i class="fas fa-wallet"></i>合計金額:' . $order['total'] .
    '円&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fab fa-qq"></i>注文者:' . $order['name'] . '</span>';
    echo '</footer>';
    echo '</div>';
    echo '</div>';
    echo '<h3>',$_SESSION['Users']['user_name'],'さん、ご購入ありがとうございます</h3>';
    echo '<a class="button is-success is-light is-medium" href="G1-1-1.php">サイトトップへ</a></div>';
    echo '</div>';
    unset($_SESSION['product']);
}
} else {
    echo "注文詳細のデータ挿入が失敗しました。";
}

?>