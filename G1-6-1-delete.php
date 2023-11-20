<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->prepare('delete from Favorites where user_id = ? and product_id = ?');
$sql->execute([$_SESSION['Users']['user_id'],$_POST['id']]);
echo 'お気に入りから削除しました。';
echo '<hr>';
require 'G1-6-1.php';
?>
<?php require 'footer.php'; ?>