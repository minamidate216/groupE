<?php require 'header.php'; ?>
<?php

// フォームデータをセッションに保存
if (isset($_POST['submit'])) {
    $_SESSION['User']['user_name'] = $_POST['user_name'];
    $_SESSION['User']['password'] = $_POST['password'];
    $_SESSION['User']['email'] = $_POST['email'];
    $_SESSION['User']['address'] = $_POST['address'];
}

// セッションからデータを取得
$user_name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
$password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
$email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
$address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

// セッションから取得したデータを表示
echo '<div class="content">';
    echo '<div class="container">';
        echo '<div class="has-text-primary">';
            echo '<div class="has-text-centered has-text-primary">';
            echo '<h3>会員登録情報確認</h3>';
            echo '</div>';
        echo '<table>';
        echo '<tr><td>名前</td><td>', $user_name, '</td></tr>';
        echo '<tr><td>パスワード</td><td>', $password, '</td></tr>';
        echo '<tr><td>メールアドレス</td><td>', $email, '</td></tr>';
        echo '<tr><td>住所</td><td>', $address, '</td></tr>';
        echo '</table>';
        echo '</div>';

        echo '<div class="has-text-centered">';
        echo '<form action="G1-2-6.php" method="post">';
        echo '<input type="submit" name="submit" value="登録する">';
        echo '</form>';
        ?>
        <?php
        $backURL = $_SERVER['HTTP_REFERER']; // 前のページのURLを取得
        ?>
        
        <!-- 戻るボタン -->
        <a href="<?php echo $backURL; ?>">戻る</a>
        <?php
        echo '</div>';
        
    echo '</div>';
echo '</div>';
?>
<?php require 'footer.php'; ?>