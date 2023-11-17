<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="login.php">ログインへ';
}else{
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('SELECT p.description, p.product_img, o.date, p.product_id, p.product_name, p.price, od.quantity FROM Orders AS o JOIN OrdersDetails AS od ON o.order_id = od.order_id LEFT OUTER JOIN Products AS p ON od.product_id = p.product_id WHERE o.user_id = ?');
$sql->execute([$_SESSION['Users']['user_id']]);
if($sql->rowCount() > 0){
foreach($sql as $row){
    $price = $row['price']*$row['quantity'];
    echo '<table class="table is-striped">';
    echo '<tr><th></th><th>商品名</th><th>値段</th><th>注文日</th><th></th></tr>';
    echo '<tr>';
    echo '<td><a href="detail.php?id=',$row['product_id'],'">';
    echo '<img alt="image" width="100" height="100" src="../image/', $row['product_img'], '"></a></td>';
    echo '<td><a href="detail.php?id=',$row['product_id'],'">',$row['product_name'],'</a></td>'; 
    echo '<td>',$price,'</td>';
    echo '<td>',$row['date'],'</td>'; 
    echo '<td>';
    echo '<form action="cart-insert.php" method="post">';
    echo '<input type="hidden" name=id value="',$row['product_id'], '">';
    echo '<input type="hidden" name=name value="',$row['product_name'], '">';
    echo '<input type="hidden" name=description value="',$row['description'], '">';
    echo '<input type="hidden" name=price value="',$row['price'], '">';
    echo '<input type="hidden" name=count value="1">';
    echo '<input type="hidden" name=image value="',$row['product_img'], '">';
    echo '<button type="submit">カートに追加</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
}
else{
    echo '過去の注文履歴がありません。';
}
}
?>
<?php require 'footer.php'; ?>