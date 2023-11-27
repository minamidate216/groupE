<?php session_start(); ?>
<?php require 'db-connect.php'; ?>

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報更新画面</title>
    <style>
        body {
            text-align: center;
        }
 
        form {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <form action="G2-2-7.php" method="post" enctype="multipart/form-data">
        <h1>商品情報更新画面</h1>
        <p>商品名 <input type="text" name="name" maxlength="30"></p>
        <p>商品価格 <input type="text" name="price" maxlength="10"></p>
        <p>商品説明 <input type="text" name="aaa"  maxlength="500"></textarea></p>
        <p>商品画像 <input type="file" name="productImage"></p>
        <p>内容量 <input type="text" name="internalcapacity" maxlength="5"></p>
        <p>カテゴリ
            <select name="category">
                <option value="category1">カテゴリ1</option>
                <option value="category2">カテゴリ2</option>
            </select>
        </p>
        <p>在庫数 <input type="text" name="zaiko" maxlength="8"></p>
        <a href="G2-2-1.php">保存せずに戻る</a>
        <button type="submit">更新</button>
    </form>
</body>
</html>
