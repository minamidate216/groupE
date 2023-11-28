<?php require 'midasi.php'; ?>
<h2>新しいコラムを登録する</h2>
<form action="G2-3-3.php" method="post" enctype="multipart/form-data">
    コラムタイトル: <input type="text" name="column_title"><br>
    画像ファイル: <input type="file" name="post_img"><br>
    本文: <textarea name="content" rows="4" cols="50"></textarea><br>
    更新日時: <input type="date" name="post_data"><br>
    追加者ID: <input type="text" name="admin_id"><br>
    <input type="submit" value="登録する">
</form>
<?php require 'footer.php'; ?>