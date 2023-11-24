<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
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
    echo '<h2>ご購入が完了しました。</h2>';
    echo '<p>注文ID: ' . $orderId . '</p>';
} else {
    echo "注文に失敗しました。";
    '<a href="G1-10-1.php">購入確認画面に戻る</a>';
}
// orderテーブルここまで


// OrdersDetailsテーブル
// 注文詳細をOrdersDetailsテーブルに挿入
    foreach ($_SESSION['product'] as $productId => $product) {
        $quantity = $product['count']; // カートの商品の数量
        $detailSql = "INSERT INTO OrdersDetails (order_id, product_id, quantity) VALUES (?, ?, ?)";
        $detailStmt = $pdo->prepare($detailSql);
        $detailStmt->execute([$orderId, $productId, $quantity]);
    }
    if ($detailStmt) {
        echo '注文詳細のデータ挿入が成功しました。';
    } else {
        echo "注文詳細のデータ挿入が失敗しました。";
    }
    foreach ($_SESSION['product'] as $id => $product) {
    echo '<div class="cart-items">';
    echo '<img src= "image/', $product['image'], '" style="width: 100px";>';
    echo '<p>', $product['name'], '</p>';
    echo '<p>', $product['count'], '個</p>';
    echo '</div>';

}
echo '<h3>ご購入ありがとうございます</h3>';
unset($_SESSION['product'][$productId]);
// insert文はここまで

// バックエンドの処理はうまくいったが最後に注文内容が表示されない
// ページを再度読み込むと同じ注文がテーブルに保存されてしまう
// ⇧インサート文は別ファイルに分けるべきか

?>
<a href="G1-1-1.php">サイトトップへ</a>