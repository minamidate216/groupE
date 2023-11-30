<?php require 'midasi.php'; ?>
<h2>管理者登録</h2>
<form action="G2-1-2.php" method="post">
<label for="admin_name">氏名:</label>
    <input type="text" name="admin_name" required><br>

    <label for="email">メールアドレス:</label>
    <input type="email" name="email" required><br>

    <label for="admin_id">ID:</label>
    <input type="text" name="admin_id" maxlength="8" required><br>

    <label for="password">パスワード:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="新規登録">
</form>
<?php require 'footer.php'; ?>