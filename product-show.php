<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
$check=0;
$pdo = new PDO($connect, USER, PASS);
if(!empty($_POST['keyword'])){
    $sql = $pdo->prepare('select * from Products where product_name like ?');
    $sql->execute(['%'. $_POST['keyword']. '%']);
    if($sql->rowCount() == 0){
        echo '商品が見つかりませんでした。';
        $check=1;
    }
    else{
        echo '<h1>「',$_POST['keyword'],'」を含む商品の検索結果</h1>';
    }
}else{
    $sql = $pdo->query('select * from Products');
}
if($check==0){
echo '<table class="table is-striped is-fullwidth">';
echo '<tr class="has-background-success"><th></th><th>商品名</th><th>商品説明</th><th>価格</th></tr>';
foreach($sql as $row){
    $id = $row['product_id'];
    echo '<tr>';
    echo '<td><a href="detail.php?id=',$row['product_id'],'">';
    echo '<img alt="image" width="100" height="100" src="../image/', $row['product_img'], '"></a></td>';
    echo '<td>';
    echo '<a href="detail.php?id=', $id, '">', $row['product_name'], '</a>';
    echo '</td>';
    echo '<td>',$row['description'];
    echo '</td>';
    echo '<td>',$row['price'],'</td>';
    echo '</tr>';
    echo '</div>';
}
echo '</table>';
}
?>
<?php require 'footer.php'; ?>