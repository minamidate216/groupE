<?php require 'header.php'; ?>
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
    echo '<div class="test has-text-centered">';
    echo '<table class="table is-striped column">';
    echo '<tr class="has-background-success"><th style="width: 30%">注文番号：',$row['order_id'],'</th><th></th><th style="width: 42%">購入日：',$date,'</th><th></th><th style="width: 28%"></th></tr>';
    echo '<tr">';
    echo '<td>';
    echo '<img alt="image" width="100" height="100" src="image/', $row['product_img'], '"></a></td>';
    echo '<td></td>';
    echo '<td style="has-text-centered"  class="textBr is-vcentered">',$row['product_name'];
    if($row['COUNT(p.product_id)']>1){
        echo 'など',$row['COUNT(p.product_id)'],'点';
    }
    echo '</td>'; 
    echo '<td></td>'; 
    echo '<td class="is-vcentered">';
    echo '<form action="G1-7-2.php" method="post">';
    echo '<input type="hidden" name=orderId value="',$row['order_id'], '">';
    echo '<input type="hidden" name=Date value="',$date, '">';
    echo '<button type="submit">詳細を表示</button>';
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
<style>
    .test{
        margin: 20px auto ;
    }
.textBr{
    width: 320px;
}
</style>
<?php require 'footer.php'; ?>