<?php

require 'db-connect.php';
require 'header.php';

// 商品IDが渡されていない場合はエラー表示
if (!isset($_GET['product_id'])) {
    die('商品IDが指定されていません。');
}

$productId = $_GET['product_id'];

try {
    $connect = new PDO($connect, USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 商品情報を取得（Categoryテーブルとの結合を追加）
    $query = "SELECT Products.*, Category.category FROM Products
              LEFT JOIN Category ON Products.category_id = Category.category_id
              WHERE product_id = :product_id";

    $stmt = $connect->prepare($query);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();
    $productData = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$productData) {
        // 商品が見つからない場合は削除完了メッセージとボタンを表示
        echo '<p>商品を削除しました。</p>';
        echo '<a href="G2-2-1.php"><button type="button" class="button is-primary">商品更新・削除へ</button></a>';
        exit(); // ここでスクリプトの実行を終了する
    }
} catch (PDOException $e) {
    die('データベースエラー: ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/aa.css">
    <title>商品削除</title>
</head>
<body>
    <h1 class=has-text-primary-dark>商品削除</h1>
    <table>
        <tr>
            <th class=has-text-primary-dark>商品名</th>
            <th class=has-text-primary-dark>商品価格</th>
            <th class=has-text-primary-dark>商品説明</th>
            <th class=has-text-primary-dark>商品画像</th>
            <th class=has-text-primary-dark>内容量</th>
            <th class=has-text-primary-dark>カテゴリ</th>
            <th class=has-text-primary-dark>在庫数</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($productData['product_name']); ?></td>
            <td><?php echo htmlspecialchars($productData['price']); ?></td>
            <td><?php echo htmlspecialchars($productData['description']); ?></td>
            <td><?php echo htmlspecialchars($productData['product_img']); ?></td>
            <td><?php echo htmlspecialchars($productData['capacity']); ?></td>
            <td><?php echo htmlspecialchars($productData['category']); ?></td>
            <td><?php echo htmlspecialchars($productData['quantity']); ?></td>
        </tr>
    </table>
    <form method="post" action="G2-3-7.php?product_id=<?php echo $productId; ?>">
    <button class="button is-primary">削除</button>
    <a href="G2-2-1.php"><button type="button" class="button is-primary">戻る</button></a>
</form>
</body>
</html>

<?php require 'footer.php'; ?>