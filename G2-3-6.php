<?php
session_start();
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
        echo '削除完了';
        echo '<a href="G2-2-1.php">G2-2-1に戻る</a>';
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
    <link rel="stylesheet" href="css/top.css">
    <title>商品削除</title>
</head>
<body>
    <h1>商品削除</h1>
    <p>以下の商品を削除しますか？</p>
    <table align="center" border="1">
        <tr>
            <th>商品名</th>
            <th>商品画像</th>
            <th>価格</th>
            <th>カテゴリ</th>
            <th>在庫数</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($productData['product_name']); ?></td>
            <td><?php echo htmlspecialchars($productData['product_img']); ?></td>
            <td><?php echo htmlspecialchars($productData['price']); ?></td>
            <td><?php echo htmlspecialchars($productData['category']); ?></td>
            <td><?php echo htmlspecialchars($productData['quantity']); ?></td>
        </tr>
    </table>
    <form method="post" action="G2-3-7.php?product_id=<?php echo $productId; ?>">
        <input type="submit" value="削除">
    </form>

    <a href="G2-2-1.php">商品一覧に戻る</a>
</body>
</html>

<?php require 'footer.php'; ?>


