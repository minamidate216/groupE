<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
$pdo = new PDO($connect, USER, PASS);

// セッションに保存されている商品idの取得
$productIds = array_keys($_SESSION['product']);


// insert文（理想としては処理が上手くいったらこのページを表示させたい今はsqlの実行とセッションからのカート情報を同じファイルにしてまう）
// Ordersテーブル
// セッションからユーザーIDを取得
$userId = $_SESSION['user_id'];
echo var_dump($_SESSION['Users']);
// 現在の日時
$currentDateTime = date('Y-m-d H:i:s');

$sql = "INSERT INTO Orders (user_id, date) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
// SQL文を実行
$stmt->execute([$userId, $currentDateTime]);

// 成功したかどうかをチェック
if ($stmt) {
    $orderId = $pdo->lastInsertId(); // 新しく挿入された注文のIDを取得
    echo "注文が成功しました。注文ID: " . $orderId;
} else {
    echo "注文に失敗しました。";
    '<a href="G1-10-1.php">購入確認画面に戻る</a>';
}


// OrdersDetailsテーブル
// 注文詳細をOrdersDetailsテーブルに挿入
foreach ($_SESSION['product'] as $productId => $product) {
    $quantity = $product['count']; // カートの商品の数量

    $detailSql = "INSERT INTO OrdersDetails (order_id, product_id, quantity) VALUES (?, ?, ?)";
    $detailStmt = $pdo->prepare($detailSql);
    $detailStmt->execute([$orderId, $productId, $quantity]);

    if ($detailStmt) {
        echo "注文詳細が成功しました。";
    } else {
        echo "注文詳細に失敗しました。";
    }
}



?>





