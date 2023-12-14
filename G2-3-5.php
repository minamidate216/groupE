<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<?php 
// データベース接続
$conn = new PDO($connect, USER, PASS);
if(!isset($_SESSION['admin'])){
    echo '<h2 style="text-align:center" class=has-text-primary-dark>ログインしてください<h2>';
    echo '<div class="has-text-centered">
    <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
    </div>';
    exit();
}
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コラム更新画面</title>
    <style>
 
        form {
            text-align: center;
            width: 400px;
            margin:0 auto;
        }

        h1 {
            margin-bottom: 10px; 
            font-size: 35px;
        }

        p {
            color: #4CAF50; /* 薄緑色 */
            margin-bottom: 10px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin: 4px 0;
            display: inline-block;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <form action="G2-3-6.php" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="column_id" value="<?= $row['column_id'] ?>">
        <h1>コラム更新</h1>
        <p><label for="column_title">商品名</label>
        <input type="text" name="column_title" maxlength="30" value="<?= $row['column_title'] ?>" required></p>

        <p><label for="post_img">画像</label>
        <p><img src="<?= $row['post_img'] ?>" alt="商品画像" width="200px">
        <input type="file" name="post_img" required></p>

        <p><label for="content">商品説明</label>
        <textarea name="content" id="" cols="30" rows="10" required><?= $row['content'] ?></textarea></p>
        <a href="G2-3-1.php" ><button type="button"class="button is-primary" >保存せず戻る</button></a>

        <button class="button is-primary">更新</button>
    </form>
</body>
</html>


