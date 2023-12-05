<?php
require 'db-connect.php';
require 'header.php'; ?>

<?php
try {
    $connect = new PDO($connect, USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('接続失敗: ' . $e->getMessage());
}

// 商品情報とカテゴリ名を結合して取得
$query = "SELECT Products.*, Category.category FROM Products
          INNER JOIN Category ON Products.category_id = Category.category_id";

try {
    $stmt = $connect->query($query);
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('クエリ失敗: ' . $e->getMessage());
}
    
// データベースからカテゴリを取得
$result = $connect->query("SELECT category FROM Category");
$categories = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Add custom styles here if needed */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            margin: 0;
        }

        form {
            width: 50%; /* Adjust the width as needed */
            margin-top: 50px; 
        }
    </style>
</head>
<body>
<form action="G2-2-3.php" method="post" enctype="multipart/form-data">
        <h1 class=has-text-primary-dark>商品登録</h1>
        <p class=has-text-primary-dark>商品名 <input type="text" name="product_name" maxlength="30"kk></p>
        <p class=has-text-primary-dark>商品価格 <input type="text" name="price" maxlength="10" ></p>
        <p class=has-text-primary-dark>説明 <input type="text" name="description" maxlength="500"></p>
        <p class=has-text-primary-dark>画像 <input type="file" name="product_img" ></p>
        <p class=has-text-primary-dark>内容量 <input type="text" name="capacity" maxlength="5"></p>
    <label for="category" class=has-text-primary-dark>カテゴリー</label>
    <select name="category" required>
        <?php foreach ($categories as $category) : ?>
            <option value="<?= htmlspecialchars($category['category']) ?>"><?= htmlspecialchars($category['category']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <p class=has-text-primary-dark>在庫数 <input type="text" name="quantity" maxlength="8"></p>
    <button class="button is-primary">新規登録</button>
</form>
</body>
</html>
<?php require 'footer.php'; ?>