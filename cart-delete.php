<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
unset($_SESSION['product'][$_GET['id']]);
echo 'カートから削除しました。';
echo '<hr>';
?>
<?php require 'cart.php'; ?>
<?php require 'footer.php'; ?>