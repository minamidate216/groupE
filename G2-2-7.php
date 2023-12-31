<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品情報更新完了画面</title>
    <style>
        form {
            text-align: center;
            width: 400px;
            margin:0 auto;
        }
        h1 {
            margin-bottom: 10px; 
            font-size: 35px;
        }

        h3 {
            color: #4CAF50; /* 薄緑色 */
            margin-bottom: 20px;
            font-size: 24px;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
<?php
    // データベース接続
    $pdo = new PDO($connect, USER, PASS);
    if(!isset($_SESSION['admin'])){
        echo '<h2 style="text-align:center" class=has-text-primary-dark>ログインしてください<h2>';
        echo '<div class="has-text-centered">
        <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
        </div>';
        exit();
    }
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $product_img = $_POST['product_img'];
        $capacity = $_POST['capacity'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
    
    $admin_id=$_SESSION['admin']['id'];
    $sql = "update Products set product_name = ?, price = ?, description = ?, product_img = ?, capacity = ?,category_id = ?, quantity = ? ,admin_id = ? where product_id = ?";
    $result = $pdo->prepare($sql);
    $result->execute([$product_name, $price, $description, $product_img, $capacity, $category, $quantity, $admin_id,$product_id]);
    
?>
<form action="G2-2-1.php" method="post">
        <h3>商品情報更新を完了しました</h3>
        <button class="button is-primary">商品更新・削除へ</button>
    </form>
</body>
</html>


