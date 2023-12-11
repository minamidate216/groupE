<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    echo '<h1 class="has-text-centered is-size-2">LOG OUT</h1>';
    echo '<hr>';
    echo '<p class="is-size-4 has-text-centered" style="margin: 30px ">ログアウトしますか？</p>';
    echo '<form action="G1-2-8.php">';
    echo '<button type="submit" id="hoge">ログアウト</button>';
    echo '</form>';
}else{
    echo '<h1 class="is-size-2 has-text-centered">ログインしていません。';
}
?>
<style>
button{
    display: block;
    margin: auto;
}
</style>
<?php require 'footer.php'; ?>