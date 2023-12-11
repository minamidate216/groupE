<?php session_start(); ?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
    p {
            color: #4CAF50; /* 薄緑色 */
            margin: 10px 0;
        }
</style>
    <title>Document</title>
</head>
<body>
<?php
if (isset($_SESSION['admin'])){
    unset($_SESSION['admin']);
    echo '<p style="text-align:center">ログアウトしました。</p>';
    echo '<div  class="has-text-centered">
    <a href="G2-1-4-login-input.php" ><button type="button"class="button is-primary">ログイン画面へ</button></a> 
    </div>';
}else{
    echo '<p style="text-align:center">すでにログアウトしています</p>';
}
?>
</body>
</html>