<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $product_img = $_POST['product_img'];
        $capacity = $_POST['capacity'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        if(!empty($_FILES['product_img'])){
            //ファイルの保存先
            $upload = './uploads/'.$_FILES['product_img']['name']; 
            //アップロードが正しく完了したかチェック
            if(move_uploaded_file($_FILES['product_img']['tmp_name'], $upload)){
                $product_img=$upload;
            }
        }
        $description = $_POST["description"];

        echo "<h1>商品情報更新確認画面</h1>";
        echo "<p>商品名: $product_name</p>";
        echo "<p>商品価格: $price</p>";
        echo "<p>商品説明: $description</p>";
        echo "<p>商品画像: $product_img</p>";
        echo '<p>画像: <img src="',$product_img, '" alt="商品画像" width="200px"></p>';
        echo "<p>内容量: $capacity</p>";
        echo "<p>カテゴリ: $category</p>";
        echo "<p>在庫数: $quantity</p>";
    }
    echo '<form action="G2-2-7.php" method="post">';
    echo '<input type="hidden" name="product_id" value="',$product_id,'">';
    echo '<input type="hidden" name="product_name" value="',$product_name,'">';
    echo '<input type="hidden" name="price" value="',$price,'">';
    echo '<input type="hidden" name="description" value="',$description,'">';
    echo '<input type="hidden" name="product_img" value="',$product_img,'">';
    echo '<input type="hidden" name="capacity" value="',$capacity,'">';
    echo '<input type="hidden" name="category" value="',$category, '">';
    echo '<input type="hidden" name="quantity" value="', $quantity ,'"></p>';
    ?>
    <button type="submit">更新</button></form>
    <a href="G2-2-1.php">戻る</a></p>
   
</body>
</html>

