<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    unset($_SESSION['Users']);
    unset($_SESSION['product']);
    echo 'ログアウトしました。';
    echo '<form action="G1-1-1.php">';
    echo '<button type="submit">トップへ</button>';
    echo '</form>';
} else {
    echo 'すでにログアウトしています。';
}
//そもそもif文いるか検証
?>
<?php require 'footer.php'; ?>
