<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>

<?php 
if(!isset($_GET['product_id'])){
    echo "不正なアクセスです";
    exit();
}
// データベース接続
$conn = new PDO($connect, USER, PASS);
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
        select {
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
        <p>商品名 <input type="text" name="product_name" maxlength="30" value="<?= $row['product_name'] ?>"></p>
        <p>商品価格 <input type="text" name="price" maxlength="10" value="<?= $row['price'] ?>"></p>
        <p>商品説明<textarea name="description" id="" cols="30" rows="10"><?= $row['description'] ?></textarea></p>
        <p><img src="<?= $row['product_img'] ?>" alt="商品画像" width="200px">
        <input type="hidden" name="product_img" value="<?= $row['product_img'] ?>"></p>
        <p>画像 <input type="file" name="product_img" ></p>
        <p>内容量 <input type="text" name="capacity" maxlength="5" value="<?= $row['capacity'] ?>"></p>
        <label for="category">カテゴリー</label>
        <select name="category" id="category" onchange="checkOtherOption(this)">
        <?php
        var_dump($Category);
        foreach($Category as $value){
            echo '<option value="', $value['category_id'], '">', $value['category'], '</option>';
        }
        ?>
        </select>
        <!--
        <input type="text" name="otherCategory" id="otherCategory" placeholder="その他のカテゴリ" style="display: none;">
        <script>
            function checkOtherOption(select) {
                var otherCategoryInput = document.getElementById("otherCategory");

                // 選択されたオプションが「その他」の場合、入力欄を表示
                if (select.value === "other") {
                    otherCategoryInput.style.display = "inline-block";
                    otherCategoryInput.required = true;
                } else {
                    otherCategoryInput.style.display = "none";
                    otherCategoryInput.required = false;
                }
            }
        </script>
        -->
        <label for="quantity">在庫数</label>
        <input type="text" name="quantity" maxlength="8" required  value="<?= $row['quantity'] ?>"><br>
        <a href="G2-2-1.php" ><button type="button"class="button is-primary" >保存せず戻る</button></a>
        <button class="button is-primary">更新</button>
    </form>
</body>
</html>




