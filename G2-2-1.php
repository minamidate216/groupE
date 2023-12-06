<?php session_start();
require 'db-connect.php';
require 'header.php';

try {
    $connect = new PDO($connect, USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

try {
    // 商品情報とカテゴリ名を結合して取得
    $query = "SELECT Products.*, Category.category FROM Products
              INNER JOIN Category ON Products.category_id = Category.category_id";
    $stmt = $connect->query($query);
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/aa.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>商品一覧</title>
</head>
<style>
    h1 {
    text-align: center; /* 見出しを中央寄せ */
}
</style>
<body>
    <form action="G2-2-2.php" method="post">
        <h1 class="has-background-success">商品一覧</h1>
        <table class="table is-bordered is-fullwidth">
            <tr>
                <th class="has-background-success">商品名</th>
                <th class="has-background-success">商品画像</th>
                <th class="has-background-success">価格</th>
                <th class="has-background-success">カテゴリ</th>
                <th class="has-background-success">在庫数</th>
            </tr>
            <?php foreach ($product as $productData): ?>
                <tr>
                    <td><?php echo htmlspecialchars($productData['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($productData['product_img']); ?></td>
                    <td><?php echo htmlspecialchars($productData['price']); ?></td>
                    <td><?php echo htmlspecialchars($productData['category']); ?></td>
                    <td><?php echo htmlspecialchars($productData['quantity']); ?></td>
                    <td class="has-background-success"><a href="G2-2-5.php?product_id=<?php echo $productData['product_id']; ?>">更新</a></td>
                    <td class="has-background-success"><a href="G2-3-6.php?product_id=<?php echo $productData['product_id']; ?>">削除</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="G2-2-2.php">新規登録</a>
    </form>
</body>
</html>
<?php require 'footer.php'; ?>
