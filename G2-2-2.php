<?php
require 'db-connect.php';
require 'header.php'; ?>

<?php
if(!isset($_SESSION['admin'])){
    echo '<h1 style="text-align:center" class=has-text-primary-dark>ログインしてください<h1>';
    echo '<div class="has-text-centered">
    <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
    </div>';
    exit();
}
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
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       

        form {
            text-align: center;
            max-width: 400px; /* フォームの最大幅を指定 */
            margin: 0 auto; /* フォームを中央に配置 */
        }

        /* フォーム内の要素にスタイルを追加 */
        .box {
            background-color: #f4f4f4; /* ボックスの背景色を指定 */
            padding: 20px; /* パディングを追加 */
            border-radius: 8px; /* 角を丸める */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* ドロップシャドウを追加 */
        }

        .has-text-primary-dark {
            margin-bottom: 10px; /* テキスト間に余白を追加 */
        }

        /* ボタンにスタイルを追加 */
        button {
            background-color: #3273dc;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
       
    </style>
    <title>Document</title>
</head>
<body>
    <form action="G2-2-3.php" method="post" enctype="multipart/form-data" class="box">
        <h1 class="has-text-primary-dark">商品登録</h1>
        <div class="box">
            <p class="has-text-primary-dark">商品名 <input type="text" name="product_name" maxlength="30"></p>
            <p class="has-text-primary-dark">商品価格 <input type="text" name="price" maxlength="10"></p>
            <p class="has-text-primary-dark">説明 <input type="text" name="description" maxlength="500"></p>
            <p class="has-text-primary-dark">画像 <input type="file" name="product_img"></p>
            <p class="has-text-primary-dark">内容量 <input type="text" name="capacity" maxlength="5"></p>
            <label for="category" class="has-text-primary-dark">カテゴリー</label>
            <select name="category" required>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= htmlspecialchars($category['category']) ?>"><?= htmlspecialchars($category['category']) ?></option>
                <?php endforeach; ?>
            </select><br>
            <p class="has-text-primary-dark">在庫数 <input type="text" name="quantity" maxlength="8"></p>
            <button class="button is-primary">新規登録</button>
        </div>
    </form>
</body>
</html>
<?php require 'footer.php'; ?>
