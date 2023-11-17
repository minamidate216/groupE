<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    echo '<p>ログアウトしますか？</p>';
    echo '<a href="logout-output.php">ログアウト</a>';
}else{
    echo 'ログインしていません。';
}
?>
<?php require 'footer.php'; ?>