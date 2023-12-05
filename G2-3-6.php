<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $column_id = $_POST["column_id"];
        $column_title = $_POST["column_title"];
        $post_img=$_POST["post_img"];
        if(!empty($_FILES['post_img'])){
            //ファイルの保存先
            $upload = './uploads/'.$_FILES['post_img']['name']; 
            //アップロードが正しく完了したかチェック
            if(move_uploaded_file($_FILES['post_img']['tmp_name'], $upload)){
                $post_img=$upload;
            }
        }
        $content = $_POST["content"];

        echo "<h1>コラム更新確認</h1>";
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
    <button class="button is-primary">更新</button>
    <a href="G2-3-1.php" ><button type="button"class="button is-primary" >戻る</button></a>

</body>
</html>