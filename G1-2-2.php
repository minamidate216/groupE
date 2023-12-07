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
    echo '<div id="app">';
    echo '<p
    v-if="isInValidEmail"
    class="error has-text-danger"
    >Eメールアドレスの形式で入力してください</p>';
    echo '<form action="G1-2-2.php" method="post">';
    echo '<input type="email" name="mail" v-model="mail"><br>';
    echo '<button type="submit">送信</button>';
    echo '</form>';
    echo '</div>';
}
?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="./script/script.js"></script>
<?php require 'footer.php'; ?>