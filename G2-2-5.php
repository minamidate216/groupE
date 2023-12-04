<?php session_start(); ?>
<?php require 'db-connect.php'; ?>

<?php 
if(!isset($_GET['id'])){
    echo "不正なアクセスです";
    exit();
}
// データベース接続
$conn = new PDO($connect, USER, PASS);
// Columnsテーブルからデータ取得
$sql = "SELECT * FROM Products WHERE product_id = ?";
$result = $conn->prepare($sql);
$result->execute([$_GET['id']]);
$row = $result->fetch();
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
<form action="G2-2-6.php" method="post" enctype="multipart/form-data" >
        <h1>商品情報更新画面</h1>
        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
        <p>商品名 <input type="text" name="product_name" maxlength="30" value="<?= $row['product_name'] ?>"></p>
        <p>商品価格 <input type="text" name="price" maxlength="10" value="<?= $row['price'] ?>"></p>
        <p>商品説明<textarea name="description" id="" cols="30" rows="10"><?= $row['description'] ?></textarea></p>
        <p><img src="<?= $row['product_img'] ?>" alt="商品画像" width="200px">
        <input type="hidden" name="product_img" value="<?= $row['product_img'] ?>"></p>
        <p>画像 <input type="file" name="product_img" ></p>
        <p>内容量 <input type="text" name="capacity" maxlength="5" value="<?= $row['capacity'] ?>"></p>
        <p><label for="myComboBox">選択してください：</label>
        <select name="category">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        </p>
        <label for="quantity">在庫数</label>
        <input type="text" name="quantity" maxlength="8" required  value="<?= $row['quantity'] ?>"><br>
        <a href="G2-2-1.php">保存せず戻る</a>
        <button type="submit">更新</button>
    </form>
</body>
</html>
