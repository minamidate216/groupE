<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'midasi.php';?>
<form action="login-output.php" method="post">
    ログインID<input type="text" name="id"><br>
    パスワード<input type="password" name="password"><br>
    <input type="submit" value="ログイン">
    <a href="G2-1-1.php">新規登録</a>
    </form>