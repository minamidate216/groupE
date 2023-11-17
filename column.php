<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
echo '<h1>Miyoshi Columns</h1>';
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->query('select * from Columns');
foreach($sql as $row){
    echo '<a href="column-detail.php?column_id=',$row['column_id'],'">';
    echo '<img src="../image/',$row['post_img'],'" width=100px height=100px></a><br>';
    echo '<a href="column-detail.php?column_id=',$row['column_id'],'">',$row['column_title'],'<a/>';
    echo '<br>';
}
?>
<?php require 'footer.php'; ?>