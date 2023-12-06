<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<?php 
if(!isset($_GET['column_id'])){
    echo "不正なアクセスです";
    exit();
}
// データベース接続
$conn = new PDO($connect,USER, PASS);
// Columnsテーブルからデータ取得
$sql = "SELECT * FROM Columns WHERE column_id = ?";
$result = $conn->prepare($sql);
$result->execute([$_GET['column_id']]);
$row = $result->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=de
    vice-width, initial-scale=1.0">
    <title>コラム削除画面</title>
</head>
<body>
<h2></h2>
<div class="content">
<div class="container">
<nav class="level">
<!-- 中央揃え -->
<div class="level-item">
    <form action="G2-3-9.php" method="post" enctype="multipart/form-data" >
        <p><img src="<?= $row['post_img'] ?>" alt="コラム画像" width="200px">
        <input type="hidden" name="post_img" value="<?= $row['post_img'] ?>"></p>
        <p><div><?= $row['column_title'] ?></div></p>
        <p><div><?= $row['content'] ?></div></p>
        <p>削除しますか？</p>
        <input type="submit" value="削除">
        <a href="G2-3-1.php"><button type="button">戻る</button></a>
    </form>
</div>
</diV>
</div>
</nav>
</body>
</html>