<h2>カート一覧</h2>
<?php
if(!empty($_SESSION['product'])){
    echo '<table class="table is-striped">';
    echo '<tr><th></th><th>商品名</th><th>説明</th><th>数量</th><th>価格</th></tr>';
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
            echo '<td>', $subtotal, '</td>';
            echo '<td><a href="G1-9-1-delete.php?id=', $id, '">削除</a></td>';
            echo '</tr>';
        }
        echo '<tr><td></td><td></td><td></td><td></td><td>合計</td><td>',$total,'</td></tr>';
        echo '</table>';
        echo '<form action="G1-10-1.php">';
        echo '<button type="submit">お会計に進む</button>';
        echo '</form>';
}else{
    echo 'カートに商品がありません。';
}
?>