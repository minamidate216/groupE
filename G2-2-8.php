<?php

require 'db-connect.php';
require 'header.php';

if(!isset($_SESSION['admin'])){
    echo '<h1 style="text-align:center" class=has-text-primary-dark>ログインしてください<h1>';
    echo '<div class="has-text-centered">
    <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
    </div>';
    exit();
}
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
        echo '<p style="text-align:center" class=has-text-primary-dark>商品を削除しました。</p>';
        echo '<div class="has-text-centered">
              <a href="G2-2-1.php"><button type="button" class="button is-primary">商品更新・削除へ</button></a>
              </div>';
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
    <style>
        /* CSS スタイルを追加 */
        td p {
            margin: 0; /* デフォルトのマージンを削除 */
        }
    </style>
    <title>商品削除</title>
</head>
<body>
    <h1 class="has-text-primary-dark">商品削除</h1>

    <p><strong>商品名 </strong> <?php echo htmlspecialchars($productData['product_name']); ?></p>
    <p><strong>商品価格 </strong> <?php echo htmlspecialchars($productData['price']); ?></p>
    <p><strong>説明 </strong> <?php echo htmlspecialchars($productData['description']); ?></p>
    <p><strong>画像 </strong> <?php echo htmlspecialchars($productData['product_img']); ?></p>
    <p><strong>内容量 </strong> <?php echo htmlspecialchars($productData['capacity']); ?></p>
    <p><strong>カテゴリ </strong> <?php echo htmlspecialchars($productData['category']); ?></p>
    <p><strong>在庫 </strong> <?php echo htmlspecialchars($productData['quantity']); ?></p>

    <form method="post" action="G2-2-9.php?product_id=<?php echo $productId; ?>">
        <button class="button is-primary">削除</button>
        <a href="G2-2-1.php"><button type="button" class="button is-primary">戻る</button></a>
    </form>
</body>
</html>

<?php require 'footer.php'; ?>
