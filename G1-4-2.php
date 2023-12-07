<?php require 'header.php'; ?>
<?php
echo '<h1 class="has-text-centered is-size-2">Miyoshi Columns</h1><br><br>';
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from Columns where column_id = ?');
$sql ->execute([$_GET['column_id']]);
foreach($sql as $row){
    echo '<h2 class="title has-text-centered is-size-4">',$row['column_title'],'</h2>';
    echo '<div class="columns is-multiline">';
    echo '<div class="column"><img src="image/',$row['post_img'],'" width=350px height=350px class="column_img"></div><br>';
    echo '<br>';
    echo '<div class="column has-text-centered">',$row['content'],'</div></div>';
}
echo '<div class="btn"><a href="G1-4-1.php" class="button is-rounded is-success has-text-centered">コラム一覧に戻る</a></div>';
?>
<style>
    .column{
        margin: 50px;
    }
    .column_img{
        margin: auto 80px;
    }
    .btn{
        margin: auto 555px 50px;
    }
</style>
<?php require 'footer.php'; ?>