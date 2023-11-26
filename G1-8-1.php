<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<hr>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from Products where product_id=?');
$sql->execute([$_GET['id']]);
foreach($sql as $row) {
    echo '<p><img alt="image" src="image/', $row['product_img'], '" style="height:100px;"></p>';
    // echo '<img alt="image" src="image/', $row['product_img1'], '.jpg" style="height:100px;">
    echo '<form action="G1-9-1-insert.php" method="post">';

    echo '<p>商品説明:',$row['description'],'</p>';

    echo '<p>商品名:',$row['product_name'],'</p>';
    echo '<p>価格:',$row['price'],'</p>';
    echo '<p>内容量:',$row['capacity'],'</p>';
    echo '<p><a href="G1-6-1.php?id=',$row['product_id'],
    '">お気に入りに追加</a></p>';
    echo '<p><select name="count">';
    for ($i=1; $i<= $row['quantity']; $i++) {
        echo '<option value="', $i, '">',$i,'</option>';
    }
    echo '</select>  個</p>';
    echo '<input type="hidden" name="id" value="', $row['product_id'], '">';
    echo '<input type="hidden" name="name" value="', $row['product_name'], '">';
    echo '<input type="hidden" name="price" value="', $row['price'], '">';
    echo '<input type="hidden" name="description" value="', $row['description'], '">';
    echo '<input type="hidden" name="image" value="', $row['product_img'], '">';
    echo '<input type="hidden" name="quantity" value="', $row['quantity'], '">';
    echo '<p><input type="submit" value="カートに追加"></p>';
    echo '</form>';
}
    ?>

<?php require 'footer.php'; ?>
