<?php require 'header.php'; ?>
<h2>コラム登録</h2>
<form action="G2-3-3.php" method="post" enctype="multipart/form-data">
    コラムタイトル: <input type="text" name="column_title" required><br>
    画像ファイル: <input type="file" name="post_img" required><br>
    本文: <textarea name="content" rows="4" cols="50" maxlength="255" required></textarea><br>
    <input type="submit" value="登録">
</form>
<?php require 'footer.php'; ?>