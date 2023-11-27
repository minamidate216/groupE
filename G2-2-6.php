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
    <title>商品情報更新確認画面</title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>商品情報更新確認画面</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを取得
        $name = $_POST['name'];
        $price = $_POST['price'];
        $aaa = $_POST['aaa'];
        $productImage = $_POST['productImage'];
        $internalcapacity = $_POST['internalcapacity'];
        $category = $_POST['category'];
        $zaiko = $_POST['zaiko'];

        // 商品情報を表示
        echo "<p>商品名: $name</p>";
        echo "<p>商品価格: $price</p>";
        echo "<p>商品説明: $aaa</p>";
        echo "<p>商品画像: $productImage</p>";
        echo "<p>内容量: $internalcapacity</p>";
        echo "<p>カテゴリ: $category</p>";
        echo "<p>在庫数: $zaiko</p>";

        // 画像ファイルの処理はここに追加することができます
        // 例えば、アップロードされた画像を保存する処理など

    } else {
        echo "<p>無効なアクセスです。</p>";
    }
    ?>
        <form action="G2-2-7.php" method="post">
    <p><button type="submit">更新</button>
       <a href="G2-2-1.php">戻る</a></p>
       </form>
</body>
</html>
