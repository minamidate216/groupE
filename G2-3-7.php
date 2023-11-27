<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コラム更新完了画面</title>
    <style>
        body {
            text-align: center;
        }
 
        form {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <form action="G2-3-1.php" method="post">
        <h3>コラムの更新を完了しました</h3>
        <button type="submit">コラム管理画面へ</button>
    </form>
</body>
</html>