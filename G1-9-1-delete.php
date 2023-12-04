<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
unset($_SESSION['product'][$_GET['id']]);
echo '<div class="has-text-centered">カートから削除しました。</div>';
echo '<hr>';
?>
<?php require 'G1-9-1.php'; ?>
<?php require 'footer.php'; ?>