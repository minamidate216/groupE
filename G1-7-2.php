<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
}else{
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('SELECT p.description, p.product_img, p.product_id, p.product_name, p.price, o.date, o.order_id, od.quantity FROM Orders AS o JOIN OrdersDetails AS od ON o.order_id = od.order_id LEFT OUTER JOIN Products AS p ON od.product_id = p.product_id WHERE o.user_id = ? and od.order_id=?');
$sql->execute([$_SESSION['Users']['user_id'],$_POST['orderId']]);
if($sql->rowCount() > 0){
    $total=0;
    echo '<div class="columns ">';
    echo '<div class="column is-two-third is-offset-2">';
    echo '<table class="table is-striped column">';
    echo '<tr class="has-background-success"><th>注文番号：',$_POST['orderId'],'</th><th></th><th>購入日：',$_POST['Date'],'</th><th></th><th></th><th></th></tr>';
foreach($sql as $row){
    $date=date('Y-m-d', strtotime($row['date']));
    $price = $row['price']*$row['quantity'];
    $total += $price;
    echo '<tr>';
    echo '<td><a href="G1-8-1.php?id=',$row['product_id'],'">';
    echo '<img alt="image" width="100" height="100" src="../image/', $row['product_img'], '"></a></td>';
    echo '<td class="is-vcentered"><a href="G1-8-1.php?id=',$row['product_id'],'">',$row['product_name'],'</a></td>';
    echo '<td class="is-vcentered">',$row['price'],'円</td>';
    echo '<td class="is-vcentered">',$row['quantity'],'点</td>';
    echo '<td class="is-vcentered">',$price,'円</td>';
    echo '<td class="is-vcentered">';
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
echo '<tr><th></th><th></th><th></th><th></th><th></th><th>お買い上げ金額：',$total,'円</th></tr>';
echo '</table>';
}
else{
    echo $_POST['orderId'];
}
}
?>
<form action="G1-7-1.php">
    <button type="submit">履歴一覧に戻る</button>
</form>
<?php require 'footer.php'; ?>