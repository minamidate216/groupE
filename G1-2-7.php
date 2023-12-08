<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    echo '<h1 class="has-text-centered is-size-2">LOG OUT</h1>';
    echo '<hr>';
    echo '<p class="is-size-4 has-text-centered" style="margin: 30px ">ログアウトしますか？</p>';
    echo '<form action="G1-2-8.php">';
    echo '<button type="submit" style=" margin: 40px 500px 0px 535px">ログアウト</button>';
    echo '</form>';
}else{
    echo '<h1 class="is-size-2 has-text-centered">ログインしていません。';
}
?>
<?php require 'footer.php'; ?>