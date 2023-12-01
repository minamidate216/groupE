<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了</title>
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
<?php
$connect = new PDO($connect, USER, PASS);
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$description = $_POST['description'];
$product_img = $_POST['product_img'];
$capacity = $_POST['capacity'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];

$admin_id = $_SESSION['admin']['id'];

$sql = "INSERT INTO Products (product_name, price, product_img, description, capacity, category_id, quantity, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$result = $connect->prepare($sql);
$result->execute([$product_name, $price, $product_img, $description,$category, $capacity, $quantity, $admin_id]);
?>
<form action="G2-3-1.php" method="post">
    <h3>登録を完了しました</h3>
    <button type="submit">商品管理画面へ</button>
</form>
</body>
</html>

