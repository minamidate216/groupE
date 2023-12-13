<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>コラム更新確認</title>
    <style>
        h1 {
            margin-bottom: 10px;
            font-size: 35px;
        }

        span {
            color: #4CAF50; /* 薄緑色 */
            margin: 10px 0;
        }

        .img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 200px;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
            margin: auto; /* 中央揃え */
        }
    </style>
</head>
<body>
    <?php
    if (!isset($_SESSION['admin'])) {
        echo '<h2 style="text-align:center" class="has-text-primary-dark">ログインしてください</h2>';
        echo '<div class="has-text-centered">
                <a href="G2-1-4-login-input.php"><button type="button" class="button is-primary">ログイン画面へ</button></a>
            </div>';
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $column_id = $_POST["column_id"];
        $column_title = $_POST["column_title"];
        if (!empty($_FILES['post_img'])) {
            // ファイルの保存先
            $upload = './uploads/' . $_FILES['post_img']['name'];
            // アップロードが正しく完了したかチェック
            if (move_uploaded_file($_FILES['post_img']['tmp_name'], $upload)) {
                $post_img = $upload;
            }
        }
        $content = $_POST["content"];
        echo '<div class="columns is-centered has-text-centered">';
        echo '<div class="column is-half">';
        echo '<h1 class="title is-3 has-text-centered">コラム更新確認</h1>';
        echo '<p><span>画像</span>: <img src="', $post_img, '" alt="コラム画像" width="200px"></p>';
        echo "<p><span>コラムタイトル:</span> $column_title</p>";
        echo "<p><span>本文</span>: $content</p>";
    }
    echo '<form action="G2-3-7.php" method="post">';
    echo '<input type="hidden" name="column_id" value="', $column_id, '">';
    echo '<input type="hidden" name="post_img" value="', $post_img, '">';
    echo '<input type="hidden" name="column_title" value="', $column_title, '">';
    echo '<input type="hidden" name="content" value="', $content, '"></p>';
    ?>
    <?php echo '<span style="color:green;"> 更新しますか？ </span><br>'; ?>
    <button class="button is-primary">更新</button>
    <a href="G2-3-1.php"><button type="button" class="button is-primary">戻る</button></a>
    </form>
</body>
</html>
