<div class="has-text-centered is-size-2">カート一覧</div>
<?php
if(empty($_SESSION['Users'])){
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
}else{
if(!empty($_SESSION['product'])){
    echo '<div class="columns is-vcentered">';
    echo '<div class="test has-text-centered">';
    echo '<table class="table is-striped column">';
    echo '<tr class="has-background-success"><th></th><th class="has-text-centered is-vcentered">商品名</th><th class="has-text-centered is-vcentered">説明</th><th class="has-text-centered is-vcentered">数量</th><th class="has-text-centered is-vcentered">価格</th><th></th><th></th></tr>';
    $total=0;
        foreach($_SESSION['product'] as $id=>$product){
            echo '<tr>';
            echo '<td><a href="G1-8-1.php?id=', $id, '">';
            echo '<img alt="image" width="100" height="100" src="image/', $product['image'], '"></a></td>';
            echo '<td class="has-text-centered is-vcentered"><a href="G1-8-1.php?id=', $id, '">',
                 $product['name'], '</a></td>';
            echo '<td class="desBr has-text-centered is-vcentered">', $product['description'], '</td>';
            echo '<td class="has-text-centered is-vcentered">', $product['count'], '</td>';
            echo '<td class="has-text-centered is-vcentered">', $product['price'], '円</td>';
            $subtotal=$product['price']*$product['count'];
            $total+=$subtotal;
            echo '<td class="has-text-centered is-vcentered">', $subtotal, '円</td>';
            echo '<td class="has-text-centered is-vcentered"><a href="G1-9-1-delete.php?id=', $id, '">削除</a></td>';
            echo '</tr>';
        }
        echo '<tr><td></td><td></td><td></td><td></td><td class="has-text-right"><b>合計金額：</b></td><td><b>',$total,'円</b></td></tr>';
        echo '</table></div></div>';
        echo '<div class="button_cart has-text-centered"><a href="G1-10-1.php" class="button is-rounded is-success has-text-centered">お会計に進む</a></div>';
}else{
    echo '<h1 class="has-text-centered">カートに商品がありません。</h1>';
}
}
?>
<style>
    .test{
        margin: 40px auto;
    }
    .button_cart{
        margin: 30px auto;
    }
    .desBr{
        width: 300px;
    }
</style>