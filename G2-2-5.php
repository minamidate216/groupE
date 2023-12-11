<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>

<?php 
// データベース接続
$conn = new PDO($connect, USER, PASS);
if(!isset($_SESSION['admin'])){
    echo '<h1 style="text-align:center" class=has-text-primary-dark>ログインしてください<h1>';
    echo '<div class="has-text-centered">
    <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
    </div>';
    exit();
}
// Columnsテーブルからデータ取得
$sql = "SELECT * FROM Products WHERE product_id = ?";
$result = $conn->prepare($sql);
$result->execute([$_GET['product_id']]);
$row = $result->fetch();
// Categoryテーブルからデータ取得
$sql = "SELECT * FROM Category";
$result = $conn->prepare($sql);
$result->execute();
$Category = $result->fetchAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>商品情報更新画面</title>
    <style>
        body {
            text-align: center;
        }
 
        form {
            display: inline-block;
            text-align: left;
        }

        h1 {
            margin-bottom: 10px; 
            font-size: 35px;
        }

        p {
            color: #4CAF50; /* 薄緑色 */
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea,
        select,
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            display: inline-block;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<form action="G2-2-6.php" method="post" enctype="multipart/form-data" >
        <h1>商品情報更新画面</h1>
        <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
        <p><label for="product_name">商品名</label>
        <input type="text" name="product_name" maxlength="30" value="<?= $row['product_name'] ?>" required></p>

        <p><label for="price">商品価格</label>
        <input type="number" name="price" maxlength="10" min="0" value="<?= $row['price'] ?>" required ></p>

        <p><label for="description">商品説明</label>
        <textarea name="description" id="" cols="30" rows="10" required><?= $row['description'] ?></textarea></p>

        <p><label for="product_img">画像</label>
        <p><img src="<?= $row['product_img'] ?>" alt="商品画像" width="200px">
        <input type="file" name="product_img" required></p>

        <p><label for="capacity">内容量</label>
        <input type="number" name="capacity" maxlength="5" min="0" value="<?= $row['capacity'] ?>" required ></p>

        <p><label for="category">カテゴリー</label>
        <select name="category" id="category" onchange="checkOtherOption(this)">
        <?php
        var_dump($Category);
        foreach($Category as $value){
            echo '<option value="', $value['category_id'], '">', $value['category'], '</option>';
        }
        ?>
        </select></p>
        <p><label for="quantity">在庫数</label>
        <input type="number" name="quantity" maxlength="8" required min="0"  value="<?= $row['quantity'] ?>"><br></p>
        <a href="G2-2-1.php" ><button type="button"class="button is-primary" >保存せず戻る</button></a>
        <button class="button is-primary">更新</button>
    </form>
</body>
</html>

