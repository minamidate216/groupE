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
        echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">';
echo '<div class="content">';
    echo '<div class="container">';
            echo '<div class="has-text-centered">';
            echo '<h3>会員登録情報確認</h3>';
            echo '</div>';

        echo '<table>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">名前　　　　　　</td><td>', $user_name, '</td></tr>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">パスワード　　　</td><td>', $password, '</td></tr>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">メールアドレス　</td><td>', $email, '</td></tr>';
        echo '<tr class="column is-half is-offset-4"><td class="has-text-primary">住所　　　　　　</td><td>', $address, '</td></tr>';
        echo '</table>';
        ?>
    <div class="has-text-centered">
        <p>こちらの内容でよろしいですか</p><br>
    </div>
    <?php
        $backURL = $_SERVER['HTTP_REFERER']; // 前のページのURLを取得
    ?>
    <form action="G1-2-6.php" method="post">
            <div class="has-text-centered">
            <a class="button is-primary" href="<?php echo $backURL; ?>">　戻る　</a>
            　　　　　　
            <input class="button is-primary" type="submit" value="登録する">
            </form>
            </div> 
        </div>        
        <?php
    echo '</div>';
echo '</div>';
?>
<?php require 'footer.php'; ?>