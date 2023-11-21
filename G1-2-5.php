<?php session_start(); ?>
<?php

// フォームデータをセッションに保存
if (isset($_POST['submit'])) {
    $_SESSION['hozon']['user_name'] = $_POST['user_name'];
    $_SESSION['hozon']['password'] = $_POST['password'];
    $_SESSION['hozon']['email'] = $_POST['email'];
    $_SESSION['hozon']['address'] = $_POST['address'];
}

// セッションからデータを取得
$user_name = isset($_SESSION['hozon']['user_name']) ? $_SESSION['hozon']['user_name'] : '';
$password = isset($_SESSION['hozon']['password']) ? $_SESSION['hozon']['password'] : '';
$email = isset($_SESSION['hozon']['email']) ? $_SESSION['hozon']['email'] : '';
$address = isset($_SESSION['hozon']['address']) ? $_SESSION['hozon']['address'] : '';

// セッションから取得したデータを表示
echo '<p>名前: ', $user_name, '</p>';
echo '<p>パスワード: ', $password, '</p>';
echo '<p>メールアドレス: ', $email, '</p>';
echo '<p>住所: ', $address, '</p>';
?>

<!-- データベースに挿入する画面に遷移 -->
<form action="G1-2-6.php" method="post">
    <input type="submit" name="submit" value="登録する">
</form>
