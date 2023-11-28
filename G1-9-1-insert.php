<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
$id=$_POST['id'];
if(!isset($_SESSION['product'])){
    $_SESSION['product']=[];
}
$count=0;

if(isset($_SESSION['product'][$id])){
    $count=$_SESSION['product'][$id]['count'];
}
$_SESSION['product'][$id]=[
    'name'=>$_POST['name'],
    'price'=>$_POST['price'],
    'description'=>$_POST['description'],
    'count'=>$count+$_POST['count'],
    'image'=>$_POST['image']
];
echo '<p class="has-text-centered">カートに商品を追加しました。</p>';
echo '<hr>';
?>
<?php require 'G1-9-1.php'; ?>
<?php require 'footer.php'; ?>