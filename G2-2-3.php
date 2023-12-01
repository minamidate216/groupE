<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $capacity = $_POST['capacity'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $product_img=$_POST["product_img"];
        if(!empty($_FILES['product_img'])){
            //ファイルの保存先
            $upload = './uploads/'.$_FILES['product_img']['name'];
            //アップロードが正しく完了したかチェック
            if(move_uploaded_file($_FILES['product_img']['tmp_name'], $upload)){
                $puroduct_img=$upload;
            }
        }
            echo "<h1>商品登録確認</h1>";
        echo "<p>商品名 $product_name</p>";
        echo "<p>商品価格 $price</p>";
        echo "<p>説明 $description</p>";
        echo '<p>商品画像: <img src="',$puroduct_img, '" alt="" width="200px"></p>';
        echo "<p>内容量 $capacity</p>";
        echo "<p>カテゴリ $category</p>";
        echo "<p>在庫数 $quantity</p>";
    }
    echo '<form action="G2-2-4.php" method="post">';
    echo '<input type="hidden" name="product_name" value="',$product_name,'">';
    echo '<input type="hidden" name="price" value="',$price,'">';
    echo '<input type="hidden" name="description" value="',$description, '">';
    echo '<input type="hidden" name="product_img" value="', $product_img,'"></p>';
    echo '<input type="hidden" name="capacity" value="', $capacity ,'"></p>';
    echo '<input type="hidden" name="category" value="', $category ,'"></p>';
    echo '<input type="hidden" name="quantity" value="', $quantity ,'"></p>';
    ?>
    <button type="submit">登録</button></form>
    <a href="G2-2-1.php">戻る</a></p>
    </body>
    </html>