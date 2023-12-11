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
<div class="has-background-success-dark">
    <div style="display:inline-block">
<a href="G1-1-1.php"><img src="image/ranch.png" height="130px" width="130px"><span class="has-text-white is-size-5">miyosi farm</a>
</div>
    <div class="Columns level-right">
    <div class="column is-narrow">
            <a href="G2-4-1.php"><span class="has-text-white is-size-4">注文履歴 <div class=""><i class=""></i></div></span></a>
        </div>
        <div class="column is-narrow">
            <a href="G2-3-1.php"><span class="has-text-white is-size-4">コラム管理 <div class=""><i class=""></i></div></span></a>
        </div>
        <div class="column is-narrow">
            <a href="G2-2-1.php"><span class="has-text-white is-size-4">商品管理 <div class=""><i class=""></i></div></span></a>
        </div>
        <div class="column is-narrow">
            <a href="#"><span class="has-text-white is-size-4"><i class="far fa-envelope"></i></span></a>
        </div>
        <div class="column is-narrow">
            <a href="#"><span class="has-text-white is-size-4"><i class="fas fa-user"></i></span></a>
        </div>
        <?php
            if(!isset($_SESSION['Admins'])){
                echo '<a href="G2-1-4-input.php"><button type="submit">ログイン</button></a>';
            }else{
                echo '<a href="G2-1-5-input.php"><button type="submit">ログアウト</button></a>';
            }
        ?>
    </div>
</div>
<hr>
</body>
</html>