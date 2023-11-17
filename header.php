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
<a href="user-top.php"><img src="../image/ranch.png" height="100px" width="100px">miyosi farm</a>
<form action="product-show.php" method="post">
<input type="text" name="keyword">
<button type="submit">検索</button>
</form>
<a href="favorite-show.php">お気に入り</a>
<a href="history.php">注文履歴</a>
<a href="cart-show.php">カート</a>
<a href="column.php">コラム</a>
<?php
if(!isset($_SESSION['Users'])){
    echo '<a href="login.php">ログイン</a>';
}else{
    echo '<a href="logout.php">ログアウト</a>';
}
?>
</div>
<hr>