<div class="has-text-centered is-size-2">カート一覧</div>
<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
}else{
if(!empty($_SESSION['product'])){
    echo '<div class="columns is-vcentered">';
    echo '<div class="column is-two-third is-offset-1">';
    echo '<table class="table is-striped column">';
    echo '<tr class="has-background-success"><th></th><th>商品名</th><th>説明</th><th>数量</th><th>価格</th><th></th><th></th></tr>';
    $total=0;
        foreach($_SESSION['product'] as $id=>$product){
            echo '<tr>';
            echo '<td><a href="G1-8-1.php?id=', $id, '">';
            echo '<img alt="image" width="100" height="100" src="../image/', $product['image'], '"></a></td>';
            echo '<td><a href="G1-8-1.php?id=', $id, '">',
                 $product['name'], '</a></td>';
            echo '<td>', $product['description'], '</td>';
            echo '<td>', $product['count'], '</td>';
            echo '<td>', $product['price'], '</td>';
            $subtotal=$product['price']*$product['count'];
            $total+=$subtotal;
            echo '<td class="has-text-centered">', $subtotal, '円</td>';
            echo '<td><a href="G1-9-1-delete.php?id=', $id, '">削除</a></td>';
            echo '</tr>';
        }
        echo '<tr><td></td><td></td><td></td><td></td><td class="has-text-right">合計金額：</td><td>',$total,'円</td></tr>';
        echo '</table>';
        echo '<form action="G1-10-1.php">';
        echo '<div class="button_cart"><a href="G1-10-1.php" class="button is-rounded is-success has-text-centered">お会計に進む</a></div>';
        echo '</form>';
}else{
    echo '<h1 class="has-text-centered">カートに商品がありません。</h1>';
}
}
?>
<style>
    table{
        margin: auto 90px auto;
    }
    .button_cart{
        margin: auto 460px auto;
    }
</style>