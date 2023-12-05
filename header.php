<?php 
//セッション開始を確認
if ((function_exists('session_status')
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
        // セッション開始していなければスタート
    session_start();
}
?>
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
<div class="has-background-success-dark">
    <div style="display:inline-block">
<a href="G1-1-1.php"><img src="image/ranch.png" height="100px" width="100px"><span class="has-text-white">miyosi farm</a>
<form action="G1-5-1.php" method="post">
<input type="text" name="keyword">
<button type="submit"><i class="fas fa-search"></i></button>
</form>
</div>
    <div class="level-right">
        <div class="mr-6 is-offset-one-third level-item">
            <a href="G1-6-1-show.php"><span class="has-text-white">お気に入り <div class="icon is-size-4"><i class="far fa-heart"></i></div></span></a>
        </div>
        <div class="mr-6 level-item">
            <a href="G1-7-1.php"><span class="has-text-white">注文履歴 <div class="icon is-size-4"><i class="fas fa-history"></i></div></span></a>
        </div>
        <div class="mr-6 level-item">
            <a href="G1-9-1-show.php"><span class="has-text-white">カート <div class="icon is-size-4"><i class="fas fa-shopping-cart"></i></div></span></a>
        </div>
        <div class="mr-6 level-item">
            <a href="G1-4-1.php"><span class="has-text-white">コラム <div class="icon is-size-4"><i class="fas fa-book-open"></i></div></span></a>
        </div>
        <div class="mr-6 level-item">
            <a href="G1-3-3.php"><span class="has-text-white icon is-size-3"><i class="fab fa-creative-commons-by"></i></span></a>
        </div>
        
        <?php
            if(!isset($_SESSION['Users'])){
                echo '<a href="G1-2-1.php"><button type="submit">ログイン</button></a>';
            }else{
                echo '<a href="G1-2-7.php"><button type="submit">ログアウト</button></a>';
            }
        ?>
    </div>
</div>
<hr>