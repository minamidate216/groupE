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
echo '<p>名前: ', $user_name, '</p>';
echo '<p>パスワード: ', $password, '</p>';
echo '<p>メールアドレス: ', $email, '</p>';
echo '<p>住所: ', $address, '</p>';

echo '<form action="G1-2-6.php" method="post">';
echo '<input type="submit" name="submit" value="登録する">';
echo '</form>';
echo '<form action="G1-2-4.php" method="post">';
echo '<input type="submit" value="戻る">';
echo '<input type="button" onclick="history.back()" value="戻る1">';
echo '</form>';
?>