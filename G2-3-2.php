<?php require 'header_admin.php'; ?>
<h3 class="title is-3 has-text-centered">コラム登録</h3>
<div class="content">
<div class="container">
<nav class="level">
<!-- 中央揃え -->
<div class="level-item">
<form action="G2-3-3.php" method="post" enctype="multipart/form-data">
    コラムタイトル:　<input type="text" name="column_title" required><br>
    　画像ファイル:　<input type="file" name="post_img" required><br>
    　　　本文:　　　<textarea name="content" rows="4" cols="50" maxlength="255" required></textarea><br>
    <nav class="level">
    <!-- 中央揃え -->
    <div class="level-item">
    <input class="button has-background-success-dark has-text-white" type="submit" value="登録">
</form>
</div>
</diV>
</div>
</nav>
<?php require 'footer.php'; ?>