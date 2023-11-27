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
$result->excecute([$_GET['column_id']])
$row = $result->fetch();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=de
    vice-width, initial-scale=1.0">
    <title>コラム更新画面</title>
    <style>
        body {
            text-align: center;
        }
 
        form {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <form action="G2-3-5kakunin.php" method="post">
        <h1>コラム更新</h1>
        <p>コラムタイトル <input type="text" name="column_title" maxlength="40" value="<?= $row['column_title'] ?>"></p>
        <p>画像 <input type="file" name="post_img" value="<?= $row['post_img'] ?>"></p>
        <p>本文 <input type="text" name="content"  maxlength="255"> value="<?= $row['content'] ?>"</textarea></p>
        <a href="G2-3-1.php">保存せず戻る</a>
        <button type="submit">更新</button>
        
    </form>
</body>
</html>