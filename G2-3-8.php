<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<?php 
if(!isset($_SESSION['admin'])){
    echo 'ログインしてください<br>';
    echo '<a href="G2-1-4-input.php">ログイン</a>';
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
        </div>
        </nav>
        <p><div class="has-text-centered"><?= $row['column_title'] ?></div></p>
        <p><div class="has-text-centered"><?= $row['content'] ?></div></p>
        <p class="has-text-centered">削除しますか？</p>
        <nav class="level">
        <!-- 中央揃え -->
        <div class="level-item">
        <input class="button has-background-success-dark has-text-white" type="submit" value="削除">
        <a href="G2-3-1.php"><button class="button has-background-success-dark has-text-white" type="button">戻る</button></a>
        </div>
        </nav>
    </form>
</div>
</diV>
</body>
</html>