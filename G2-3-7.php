<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コラム更新完了画面</title>
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
<?php
    // データベース接続
    $pdo = new PDO($connect, USER, PASS);
    $column_id = $_POST['column_id'];
    $column_title = $_POST['column_title'];
    $content = $_POST['content'];
    $post_img = $_POST['post_img'];
    
    $post_data=date("Y-m-d");
    $admin_id=$_SESSION['admin']['id'];
    $sql = "update Columns set column_title = ?, content = ?, post_data = ?, post_img = ?, admin_id = ? where column_id = ?";
    $result = $pdo->prepare($sql);
    $result->execute([$column_title, $content, $post_data, $post_img, $admin_id, $column_id]);
    
?>
    <form action="G2-3-1.php" method="post">
        <h3>コラムの更新を完了しました</h3>
        <button type="submit">コラム管理画面へ</button>
    </form>
</body>
</html>