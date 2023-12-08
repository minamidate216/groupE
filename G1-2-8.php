<?php require 'header.php'; ?>
<?php
echo '<h1 class="has-text-centered is-size-2">LOG OUT</h1>';
if(isset($_SESSION['Users'])){
    unset($_SESSION['Users']);
    unset($_SESSION['product']);
    echo '<div class="is-size-4 has-text-centered">ログアウトしました。</div>';
    echo '<form action="G1-1-1.php">';
    echo '<div class="has-text-centered" style="margin: 30px"><button type="submit">トップへ</button></div>';
    echo '</form>';
} else {
    echo 'すでにログアウトしています。';
}
//そもそもif文いるか検証
?>
<?php require 'footer.php'; ?>
