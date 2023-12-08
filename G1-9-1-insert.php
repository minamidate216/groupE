<?php require 'header.php'; ?>
<?php
if(empty($_SESSION['Users'])){
    echo '<p class="has-text-centered">ログインしていないためご利用になれません。</p>';
    echo '<hr>';
}else{
$id=$_POST['id'];
if(!isset($_SESSION['product'])){
    $_SESSION['product']=[];
}
$count=0;

if(isset($_SESSION['product'][$id])){
    $count=$_SESSION['product'][$id]['count'];
}
$n=$count+$_POST['count'];
if($n<=$_POST['quantity']){
    $_SESSION['product'][$id]=[
        'name'=>$_POST['name'],
        'price'=>$_POST['price'],
        'description'=>$_POST['description'],
        'count'=>$n,
        'image'=>$_POST['image'],
        'quantity'=>$_POST['quantity'],
    ];
    
    
    echo '<p class="has-text-centered">カートに商品を追加しました。</p>';
    echo '<hr>';
    require 'G1-9-1.php';
    require 'footer.php';
}else{
    $count=$_POST['quantity'];
    echo '<h1>在庫数オーバーです。これ以上追加できません。</h1>';
    //ホスト名取得
    $h = $_SERVER['HTTP_HOST'];
 
    // リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
    if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'],$h) !== false)) {
            echo '<a href="' . $_SERVER['HTTP_REFERER'] . '"　class="a_button">前の画面に戻る</a>';
    }
}

}
?>
<style>
    a.a_button{ 
	display: block; 
	background: #0021d0;  
	padding: 10px; 
	text-decoration: none; 
	font-size: 1.2em; 
	border-radius: 10px; 
	max-width: fit-content; 
	position: relative; 
	transition: .5s; 
} 
</style>
