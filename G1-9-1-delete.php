<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
unset($_SESSION['product'][$_GET['id']]);
echo 'カートから削除しました。';
echo '<hr>';
?>
<?php require 'G1-9-1.php'; ?>
<?php require 'footer.php'; ?>