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
    $query = "SELECT * FROM Columns"; 
    $stmt = $connect->query($query);
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}
?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コラム更新確認画面</title>
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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $column_title = $_POST["column_title"];
        $post_img=$_POST["post_img"];
        $content = $_POST["content"];

        echo "<h1>コラム更新確認</h1>";
        echo "<p>コラムタイトル: $column_title</p>";
        echo "<p>画像: $post_img</p>";
        echo "<p>本文: $content</p>";

        if (isset($_FILES['post_img'])) {
            $post_img= $_FILES['post_img'];
            echo "<p>画像ファイル: $post_img</p>";
        }
    }
    ?>
    <a href="G2-3-5.php">更新</a>
    <a href="G2-3-5kousin.php">戻る</a></p>
   
</body>
</html>