<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
$a=0;
if(!empty($_POST['mail'])){
echo 'ご入力いただいたメールアドレス宛に<br/>ID・パスワード変更のメールを送信いたしました。<br>';
echo '<form action="G1-2-1.php">';
echo '<button type="submit">ログインへ</button>';
echo '</form>';
$a=1;
}
if($a!=1){
    echo '<h1>メールアドレスを入力してください</h1>';
    echo '<form action="G1-2-2.php" method="post">';
    echo '<input type="email" name="mail"><br>';
    echo '<button type="submit">送信</button>';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>