<?php session_start(); ?>
<?php require 'db-connect.php'; ?>

<?php

try {
    $connect = new PDO($connect,USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

try {
    $query = "SELECT * FROM Products"; 
    $stmt = $connect->query($query);
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <p>コラムタイトル <input type="text" name="column_title" maxlength="40"></p>
        <p>画像 <input type="file" name="post_img"></p>
        <p>本文 <input type="text" name="content"  maxlength="255"></textarea></p>
        <a href="G2-3-1.php">保存せず戻る</a>
        <button type="submit">更新</button>
        
    </form>
</body>
</html>