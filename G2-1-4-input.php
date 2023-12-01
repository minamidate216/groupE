<?php require 'db-connect.php'; ?>
<?php session_start(); ?>
<form action="G2-1-4-output.php" method="post">
    ログインID<input type="text" name="admin_id"><br>
    パスワード<input type="password" name="password"><br>
    <input type="submit" value="ログイン">
    <a href="G2-1-1.php"><button type="button">新規登録</button></a>
    </form>