<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
if(!isset($_SESSION['Users'])){
    echo 'お気に入り機能の使用にはログインが必要です。<br>';
    echo '<a href="G1-2-1.php">ログインへ</a>';
}else{
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('select * from Favorites where user_id=? and product_id = ?');
$sql->execute([$_SESSION['Users']['user_id'],$_GET['id']]);
if($sql->rowCount()==0){
    $sql = $pdo->prepare('insert into Favorites values (?,?)');
    $sql->execute([$_SESSION['Users']['user_id'],$_GET['id']]);
    echo 'お気に入りに追加しました。';
}else{
    echo '既にお気に入りに追加済みです。';
}
require 'G1-6-1.php';
}
?>