<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    echo '<p>ログアウトしますか？</p>';
    echo '<form action="G1-2-8.php">';
    echo '<button type="submit">ログアウト</button>';
    echo '</form>';
}else{
    echo 'ログインしていません。';
}
?>
<?php require 'footer.php'; ?>