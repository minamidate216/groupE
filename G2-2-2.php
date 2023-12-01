<?php
session_start();
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
$row = $result->fetch();
?>
<form action="G2-2-3.php" method="post" enctype="mulitipart/form-data">
        <h1>商品登録</h1>
        <p>商品名 <input type="text" name="product_name" maxlength="30" value="<?= $row['product_name'] ?>"></p>
        <p>商品価格 <input type="text" name="price" maxlength="10" value="<?= $row['price'] ?>"></p>
        <p>説明 <input type="text" name="description" maxlength="500" value="<?= $row['description'] ?>"></p>
        <p><img src="<?= $row['product_img'] ?>" alt="" width="200px">
        <input type="hidden" name="product_img" value="<?= $row['product_img'] ?>"></p>
        <p>画像 <input type="file" name="product_img" ></p>
        <p>内容量 <input type="text" name="capacity" maxlength="5" value="<?= $row['capacity'] ?>"></p>
    <label for="category">カテゴリー</label>
    <select name="category" required>
        <?php foreach ($categories as $category) : ?>
            <option value="<?= htmlspecialchars($category['category']) ?>"><?= htmlspecialchars($category['category']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <p>在庫数 <input type="text" name="quantity" maxlength="8" value="<?= $row['quantity'] ?>"></p>
    <input type="submit" value="新規登録">
</form>
<?php require 'footer.php'; ?>