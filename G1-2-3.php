<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
echo 'ご入力いただいたメールアドレス宛に<br/>ID・パスワード変更のメールを送信いたしました。';
?>
<br>
<form action="login.php">
    <button type="submit">ログインへ</button>
</form>
<?php require 'footer.php'; ?>