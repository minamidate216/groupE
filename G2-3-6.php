<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>コラム更新確認</title>
    <style>
        body {
            text-align: center;
        }
 
        .columns {
            margin-top: 20px;
        }

        .column {
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h1 {
            margin-bottom: 10px; 
            font-size: 35px;
        }

        p {
            color: #4CAF50; /* 薄緑色 */
            margin: 10px 0;
        }

        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 200px;
        }

        form {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $column_id = $_POST["column_id"];
        $column_title = $_POST["column_title"];
        if(!empty($_FILES['post_img'])){
            //ファイルの保存先
            $upload = './uploads/'.$_FILES['post_img']['name']; 
            //アップロードが正しく完了したかチェック
            if(move_uploaded_file($_FILES['post_img']['tmp_name'], $upload)){
                $post_img=$upload;
            }
        }
        $content = $_POST["content"];
        echo '<div class="columns is-centered  has-text-centered">';
        echo '<div class="column is-half">';

        echo '<h1 class="title is-3 has-text-centered">コラム更新確認</h1>';
        echo '<p>画像: <img src="',$post_img, '" alt="コラム画像" width="200px"></p>';
        echo "<p>コラムタイトル: $column_title</p>";
        echo "<p>本文: $content</p>";
    }
    echo '<form action="G2-3-7.php" method="post">';
    echo '<input type="hidden" name="column_id" value="',$column_id,'">';
    echo '<input type="hidden" name="post_img" value="',$post_img, '">';
    echo '<input type="hidden" name="column_title" value="',$column_title,'">';
    echo '<input type="hidden" name="content" value="', $content ,'"></p>';
    ?>
    <?php echo '<FONT COLOR="GREEN"> 更新しますか？ </FONT><br>'; ?>
    <button class="button is-primary">更新</button>
    <a href="G2-3-1.php" ><button type="button"class="button is-primary" >戻る</button></a>
</body>
</html>
