<?php session_start(); ?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css" />
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //フォームから送信されたデータを取得
    $admin_name = $_POST["admin_name"];
    $email = $_POST["email"];
    $admin_id = $_POST["admin_id"];
    $password = $_POST["password"];
}
?>
<div class="content">
<div class="container">
<h3 class="title is-3 has-text-centered">確認画面</h3>
<p class="has-text-centered">氏名: 　　<?php echo $admin_name; ?></p>
<p class="has-text-centered">メールアドレス: <?php echo $email; ?></p>
<p class="has-text-centered">ID: 　　　　<?php echo $admin_id; ?></p>
<p class="has-text-centered">パスワード:　********</p>

<form action="G2-1-3.php" method="post">
    <input type="hidden" name="admin_name" value="<?php echo $admin_name; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <p class="has-text-centered">上記の内容で登録します。</p>
    <nav class="level">
    <!-- 中央揃え -->
    <div class="level-item">
    <input class="button has-background-success-dark has-text-white" type="submit" value="登録">
    <a href="G2-1-1.php"><button class="button has-background-success-dark has-text-white" type="button">戻る</button></a>
</form>
</div>
</div>
</div>
</nav>
<?php require 'footer.php'; ?>