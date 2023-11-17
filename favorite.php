<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="login.php">ログインへ';
}else{
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select pro.product_img, pro.product_name,pro.product_id, pro.description, pro.price from Products AS pro INNER JOIN Favorites AS fav ON pro.product_id = fav.product_id WHERE fav.user_id=?');
$sql->execute([$_SESSION['Users']['user_id']]);
if($sql->rowCount() == 0){
    echo 'お気に入りに登録した商品がありません。';
}else{
    echo '<div class="columns">';
    echo '<div class="column is-two-third">';
    echo '<table class="table is-striped is-harfwidth border:">';
    echo '<tr class="has-background-success"><th></th><th>商品名</th><th>説明</th><th>価格</th><th></th><th></th><th></th></tr>';
foreach($sql as $row){
    echo '<tr><td><img src="../image/',$row['product_img'],'" width="100" height="100">';
    echo '<td class="is-narrow"><a href="detail.php?id=',$row['product_id'],'">',$row['product_name'], '</td>';
    echo '<td class="is-narrow">', $row['description'],'</td>';
    echo '<td>', $row['price'], '</td>';
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
    echo '<td>';
    echo '<form action="favorite-delete.php" method="post">';
    echo '<input type="hidden" name="id" value="', $row['product_id'],'">';
    echo '<input type="hidden" name=name value="',$row['product_name'], '">';
    echo '<input type="hidden" name=description value="',$row['description'], '">';
    echo '<input type="hidden" name=price value="',$row['price'], '">';
    echo '<input type="hidden" name=count value="1">';
    echo '<input type="hidden" name=image value="',$row['product_img'], '">';
    echo '<button type="submit">お気に入りから削除</button>';
    echo '</form>';
    echo '</td>';
    echo '</tr>';
}
}
}
?>