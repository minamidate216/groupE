<?php require 'header.php'; ?>
<?php
//フォームの情報を取得
$user_id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : '';
$user_name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
$password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
$email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
$address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

//セッションに保存された情報を表示
echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">';
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">';
echo '<div class="content">';
    echo '<div class="container">';
        echo '<div class="has-text-centered">';
        echo '<h3>マイページ情報更新確認</h3>';
        echo '</div>';
        echo '<table>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">氏名　　　　　　</td><td>', $user_name, '</td></tr>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">メールアドレス　</td><td>', $email, '</td></tr>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">パスワード　　　</td><td>', str_repeat('*', strlen($password)), '</td></tr>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">住所　　　　　　</td><td>', $address, '</td></tr>';
        echo '</table>';

            echo '<div class="has-text-centered">';
            echo '<h4>上記の内容に変更します。</h4>';
            echo '</div>';
        echo '</div>';    
    echo '</div>';
echo '</div>';

// 更新画面に情報を渡すフォーム

?>
    <?php
    $backURL = $_SERVER['HTTP_REFERER']; // 前のページのURLを取得
    ?>
    <form action="G1-3-6.php" method="post">
        <div class="has-text-centered">
        <a class="button is-primary" href="<?php echo $backURL; ?>">　戻る　</a>
        　　　　　　
        <input class="button is-primary" type="submit" value="変更する">
        </form>
        </div> 
    </div> 


<?php
require 'footer.php';
?>