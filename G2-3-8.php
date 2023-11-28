<?php session_start(); ?>
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
<?php require 'midasi.php'; ?>
<h2>コラム削除</h2>
    <form action="G2-3-9.php" method="post" enctype="multipart/form-data" >
        <p><img src="<?= $row['post_img'] ?>" alt="コラム画像" width="200px">
        <input type="hidden" name="post_img" value="<?= $row['post_img'] ?>"></p>
        <p>コラムタイトル <div><?= $row['column_title'] ?></div></p>
        <p>本文 <div><?= $row['content'] ?></div></p>
        <p><button type="submit">削除</button>
    </form>
    <button onclick = "location.href='G2-3-1.php'">削除せずに戻る</button></P>
</body>
</html>