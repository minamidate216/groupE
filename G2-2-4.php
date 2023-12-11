<?php
require 'db-connect.php';
require 'header.php';

$connect = new PDO($connect, USER, PASS);
if(!isset($_SESSION['admin'])){
    echo '<h1 style="text-align:center" class=has-text-primary-dark>ログインしてください<h1>';
    echo '<div class="has-text-centered">
    <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
    </div>';
    exit();
}
// Validate form inputs
if (empty($_POST['product_name']) || empty($_POST['price']) || empty($_POST['description']) || empty($_POST['product_img']) || empty($_POST['capacity']) || empty($_POST['category']) || empty($_POST['quantity'])) {
    die("Please fill out all required fields.");
}

$product_name = $_POST['product_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$product_img = $_POST['product_img'];
$capacity = $_POST['capacity'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];

$admin_id = $_SESSION['admin']['id'];

// categoryが存在するか確認
$checkCategory = $connect->prepare("SELECT category_id FROM Category WHERE category = ?");
$checkCategory->execute([$category]);
$existingCategory = $checkCategory->fetch(PDO::FETCH_ASSOC);

if ($existingCategory) {
    // 既存のcategoryが存在する場合
    $category_id = $existingCategory['category_id'];
} else {
    // 既存のcategoryが存在しない場合、新しいカテゴリを作成
    $createCategory = $connect->prepare("INSERT INTO Category (category) VALUES (?)");
    $createCategory->execute([$category]);

    // 新しいカテゴリの自動採番されたcategory_idを取得
    $category_id = $connect->lastInsertId();
}

// 商品を登録
$sql = "INSERT INTO Products (product_name, price, product_img, description, category_id, capacity, quantity, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$result = $connect->prepare($sql);
$result->execute([$product_name, $price, $product_img, $description, $category_id, $capacity, $quantity, $admin_id]);

?>
<form action="G2-2-1.php" method="post">
    <h3 style="text-align:center" class="has-text-primary-dark">登録を完了しました</h3>
    <div class="has-text-centered">
        <button class="button is-primary">商品管理画面へ</button>
    </div>
</form>
</body>
</html>
<?php require 'footer.php'; ?>