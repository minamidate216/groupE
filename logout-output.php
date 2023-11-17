<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    unset($_SESSION['Users']);
    echo 'ログアウトしました。';
    echo '<form action="top.php">';
    echo '<button type="submit">トップへ</button>';
    echo '</form>';
} else {
    echo 'すでにログアウトしています。';
}
?>
<?php require 'footer.php'; ?>