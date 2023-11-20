<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<hr>
<?php
$pdo = new PDO($connect, USER, PASS);
$productIds = array_keys($_SESSION['product']);
$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$sql = "SELECT * FROM Products WHERE product_id IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($productIds);
$products = $stmt->fetchAll();
// 在庫の確認をします
foreach ($_SESSION['product'] as $id => $cartItem) {
    foreach ($products as $product) {
        if ($product['product_id'] == $id) {
            if ($product['quantity'] < $cartItem['count']) {
                echo "商品ID {$id} の在庫が足りません。<br>";
            } else {
                echo "商品ID {$id} の在庫が足りています。<br>";
            }
            break; // 適切な商品が見つかったらループを終了
        }
    }
}


if (!isset($_SESSION['Users'])) {
    // ユーザーがログインしていない場合は、ログインを促す
    echo 'ログインしろや';
}

$deliveryDate = date('Y-m-d', strtotime('+2 days'));
echo "<h4>配送日</h4>";
echo "<div>", $deliveryDate, "</div>";

echo "<h4>商品情報</h4>";
// カート情報の確認
if (!empty($_SESSION['product'])) {
    echo '<table>';
    echo '<tr><th>商品画像</th><th>商品名</th>';
    echo '<th>個数</th><th>価格</th><th>小計</th><th></th></tr>';
    $total = 0;
    foreach ($_SESSION['product'] as $id => $product) {
        echo '<tr>';
        echo '<td><img src="image/', $product['image'], '" style="width: 100px;"></td>';
        echo '<td><a href="detail.php?id=', $id, '">',
            $product['name'], '</a></td>';
        echo '<td>', $product['price'], '</td>';
        echo '<td>', $product['count'], '</td>';
        $subtotal = $product['price'] * $product['count'];
        $total += $subtotal;
        echo '<td>', $subtotal, '</td>';
        echo '<td><a href="cart-delete.php?id=', $id, '">削除</a></td>';
        echo '</tr>';
    }
    echo '<tr><td>合計</td><td></td><td></td><td></td><td>', $total,
        '</td><td></td></tr>';
    echo '</table>';
} else {
    echo 'カートに商品がありません。';
}

echo '<h4>配送先</h4>';
if (isset($_SESSION['Users'])) {
    echo '<div>';
    echo '<p>名前：', $_SESSION['Users']['user_name'], '</p>';
    echo '<p>住所：', $_SESSION['Users']['address'], '</p>';
    echo '<p>連絡先：', $_SESSION['Users']['email'], '</p>';
    echo '<div>';
}
?>
<form action="G1-10-2.php">
    <input type="submit" value="購入">
</form>

<?php require 'footer.php'; ?>