<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php

try {
    $connect = new PDO($connect,USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

try {
    $query = "SELECT * FROM Products"; 
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
    <link rel="stylesheet" href="./css/top.css">
    <title>商品一覧</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center; /* Center-align the text in cells */
        }

        h1 {
            text-align: center; /* Center-align the heading */
        }
    </style>
</head>

<body>
    <form action="G2-2-2.php" method="post">
    <h1>商品一覧</h1>
    <table>
        <tr>
            <th>商品名</th>
            <th>商品画像</th>
            <th>価格</th>
            <th>カテゴリ</th>
            <th>在庫数</th>
        </tr>
        <?php foreach ($product as $productData): ?>
            <tr>
                <td><?php echo htmlspecialchars($productData['product_name']); ?></td>
                <td><?php echo htmlspecialchars($productData['product_img']); ?></td>
                <td><?php echo htmlspecialchars($productData['price']); ?></td>
                <td><?php echo htmlspecialchars($productData['category_id']); ?></td>
                <td><?php echo htmlspecialchars($productData['quantity']); ?></td>
                <td><a href="shohin_edit.php?id=<?php echo $productData['product_name']; ?>">更新</a></td>
                <td><a href="shohin_delete.php?id=<?php echo $productData['product_name']; ?>">削除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="G2-2-2.php">新規登録</a>
        </form>
</body>
</html>
<?php require 'footer.php'; ?>