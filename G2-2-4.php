<?php
require 'db-connect.php';
require 'header.php';
$connect = new PDO($connect, USER, PASS);

$product_name = $_POST['product_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$product_img = $_POST['product_img'];
$capacity = $_POST['capacity'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];

$admin_id = $_SESSION['admin']['id'];

// category_idが存在するか確認
$checkCategory = $connect->prepare("SELECT COUNT(*) FROM Category WHERE category_id = ?");
$checkCategory->execute([$category]);
$categoryExists = $checkCategory->fetchColumn();

if ($categoryExists) {
    // category_idが存在する場合のみ実行
    $sql = "INSERT INTO Products (product_name, price, product_img, description, category_id, capacity, quantity, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $connect->prepare($sql);
    $result->execute([$product_name, $price, $product_img, $description, $category, $capacity, $quantity, $admin_id]);

    ?>
    <form action="G2-2-1.php" method="post">
        <h3>登録を完了しました</h3>
        <button type="submit">商品管理画面へ</button>
    </form>
    <?php
} else {
    // category_idが存在しない場合、新しいカテゴリを作成
    $createCategory = $connect->prepare("INSERT INTO Category () VALUES ()");
    $createCategory->execute();

    // 新しいカテゴリの自動採番されたcategory_idを取得
    $newCategoryId = $connect->lastInsertId();

    // 商品を登録
    $sql = "INSERT INTO Products (product_name, price, product_img, description, category_id, capacity, quantity, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $result = $connect->prepare($sql);
    $result->execute([$product_name, $price, $product_img, $description, $newCategoryId, $capacity, $quantity, $admin_id]);

    ?>
    <form action="G2-2-1.php" method="post">
        <h3 class=has-text-primary-dark>登録を完了しました</h3>
        <button class="button is-primary">商品管理画面へ</button></form>
    </form>
    <?php
}
?>
</body>
</html>