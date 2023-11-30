<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
}else{
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('SELECT COUNT(p.product_id), p.description, p.product_img, o.order_id, o.date, p.product_id, p.product_name, p.price, od.quantity FROM Orders AS o JOIN OrdersDetails AS od ON o.order_id = od.order_id LEFT OUTER JOIN Products AS p ON od.product_id = p.product_id WHERE o.user_id = ? GROUP BY o.order_id ORDER BY o.order_id DESC');
$sql->execute([$_SESSION['Users']['user_id']]);
if($sql->rowCount() > 0){
foreach($sql as $row){
    $date=date('Y-m-d', strtotime($row['date']));
    $price = $row['price']*$row['quantity'];
    echo '<div class="columns">';
    echo '<div class="column is-two-third is-offset-2">';
    echo '<table class="table is-striped column">';
    echo '<tr class="has-background-success"><th style="width: 15%">注文番号：',$row['order_id'],'</th><th style="width: 10%"></th><th style="width: 40%">購入日：',$date,'</th><th></th><th></th></tr>';
    echo '<tr>';
    echo '<td>';
    echo '<img alt="image" width="100" height="100" src="../image/', $row['product_img'], '"></a></td>';
    echo '<td></td>';
    echo '<td style="has-text-centered">',$row['product_name'];
    if($row['COUNT(p.product_id)']>1){
        echo 'など',$row['COUNT(p.product_id)'],'点';
    }
    echo '</td>'; 
    echo '<td></td>'; 
    echo '<td>';
    echo '<form action="G1-9-1-insert.php" method="post">';
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