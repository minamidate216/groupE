<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
echo '<h1>Miyoshi Columns</h1>';
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from Columns where column_id = ?');
$sql ->execute([$_GET['column_id']]);
foreach($sql as $row){
    echo '<h2>',$row['column_title'],'</h2>';
    echo '<img src="../image/',$row['post_img'],'" width=100px height=100px><br>';
    echo '<br>';
    echo $row['content'];
    
}
echo '<form action="G1-4-1.php">';
echo '<button type="submit">コラム一覧に戻る</button>';
echo '</form>';
?>
<?php require 'footer.php'; ?>