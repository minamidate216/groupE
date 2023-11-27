<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<title>Document</title>
</head>
<body>
<div class="">
<a href="G1-1-1.php"><img src="image/top.png" height="100px" width="100px">miyosi farm</a>
<form action="G1-5-1.php" method="post">
<input type="text" name="keyword">
<button type="submit">検索</button>
</form>
<a href="G1-6-1.php">お気に入り</a>
<a href="G1-5-1.php">商品</a>
<a href="G1-7-1.php">注文履歴</a>
<a href="G1-9-1-show.php">カート</a>
<a href="G1-4-2.php">コラム</a>
<?php
if(!isset($_SESSION['Users'])){
    echo '<a href="G1-2-1.php">ログイン</a>';
}else{
    echo '<a href="G1-2-7.php">ログアウト</a>';
}
?>
</div>
<hr>