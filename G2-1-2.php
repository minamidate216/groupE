<?php require 'midasi.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //フォームから送信されたデータを取得
    $admin_name = $_POST["admin_name"];
    $email = $_POST["email"];
    $admin_id = $_POST["admin_id"];
    $password = $_POST["password"];
}
?>

<h2>確認画面</h2>
<p>氏名: <?php echo $admin_name; ?></p>
<p>メールアドレス: <?php echo $email; ?></p>
<p>ID: <?php echo $admin_id; ?></p>
<p>パスワード: ********</p>

<form action="G2-1-3.php" method="post">
    <input type="hidden" name="admin_name" value="<?php echo $admin_name; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <p>上記の内容で登録します。</p>
    <input type="submit" value="登録">
    <a href="G2-1-1.php">戻る</a>
</form>
<?php require 'footer.php'; ?>