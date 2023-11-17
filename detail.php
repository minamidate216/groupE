<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from Products where product_id=?');
$sql->execute([$_GET['id']]);
foreach($sql as $row){
    echo '<p><img alt="image" width="100" height="100" src="../image/', $row['product_img'], '"></p>';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p>商品番号:', $row['product_id'], '</p>';
    echo '<p>商品名:', $row['product_name'], '</p>';
    echo '<p>商品説明:', $row['description'], '</p>';
    echo '<p>価格:', $row['price'], '</p>';
    echo '<p>個数:<select name="count">';
    for($i=1;$i<=10;$i++){
        echo '<option value="', $i, '">', $i, '</option>';
    }
    echo '</select></p>';
    echo '<input type="hidden" name="id" value="', $row['product_id'], '">';
    echo '<input type="hidden" name="name" value="', $row['product_name'], '">';
    echo '<input type="hidden" name="description" value="', $row['description'], '">';
    echo '<input type="hidden" name="price" value="', $row['price'], '">';
    echo '<input type="hidden" name="image" value="', $row['product_img'], '">';
    echo '<p><input type="submit" value="カートに追加"></p>';
    echo '</form>';
    echo '<p><a href="favorite-insert.php?id=', $row['product_id'], '">お気に入りに追加</a></p>';
}
?>
<?php require 'footer.php'; ?>