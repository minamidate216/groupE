<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
}else{
echo '<div class="has-text-centered is-size-2" >お気に入り商品</div>';
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select pro.* from Products AS pro INNER JOIN Favorites AS fav ON pro.product_id = fav.product_id WHERE fav.user_id=?');
$sql->execute([$_SESSION['Users']['user_id']]);
if($sql->rowCount() == 0){
    echo '<div class="has-text-centered">お気に入りに登録した商品がありません。</div>';
}else{
    echo '<div class="columns">';
    echo '<div class="column is-two-third">';
    echo '<table class="table is-striped column has-background-white-ter">';
    echo '<tr class="has-background-success" style="height: 60px"><th></th><th class="has-text-centered is-vcentered">商品名</th><th class="has-text-centered is-vcentered">説明</th><th class="has-text-centered is-vcentered">価格</th><th></th><th></th><th></th><th></th></tr>';
foreach($sql as $row){
    echo '<tr><td><img src="image/',$row['product_img'],'" width="100" height="100">';
    echo '<td class="is-vcentered"><a href="G1-8-1.php?id=',$row['product_id'],'">',$row['product_name'], '</td>';
    echo '<td class="textBr is-vcentered">', $row['description'],'</td>';
    echo '<td class="is-vcentered" style="width: 70px">', $row['price'], '円</td>';
    echo '<td class="is-vcentered">';
    echo '<form action="G1-9-1-insert.php" method="post">';
    echo '<input type="hidden" name=id value="',$row['product_id'], '">';
    echo '<input type="hidden" name=name value="',$row['product_name'], '">';
    echo '<input type="hidden" name=description value="',$row['description'], '">';
    echo '<input type="hidden" name=price value="',$row['price'], '">';
    echo '<input type="hidden" name=count value="1">';
    echo '<input type="hidden" name=image value="',$row['product_img'], '">';
    echo '<input type="hidden" name=quantity value="',$row['quantity'], '">';
    echo '<button class="buttonA" type="submit">カートに追加</button>';
    echo '</form>';
    echo '</td>';
    echo '<td></td><td></td><td class="is-vcentered">';
    echo '<form action="G1-6-1-delete.php" method="post">';
    echo '<input type="hidden" name="id" value="', $row['product_id'],'">';
    echo '<input type="hidden" name=name value="',$row['product_name'], '">';
    echo '<input type="hidden" name=description value="',$row['description'], '">';
    echo '<input type="hidden" name=price value="',$row['price'], '">';
    echo '<input type="hidden" name=count value="1">';
    echo '<input type="hidden" name=image value="',$row['product_img'], '">';
    echo '<input type="hidden" name=quantity value="',$row['quantity'], '">';
    echo '<button class="buttonB" type="submit">お気に入りから削除</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
}
}
?>
<style>
table{
    margin: auto 100px auto;
}
.textBr{
    width: 300px;
}
.buttonA{
    width: 110px;
    height: 30px;
}
.buttonB{
    width: 150px;
    height: 30px;
}
</style>