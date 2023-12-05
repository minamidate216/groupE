<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
//フォームの情報を取得
$user_id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : '';
$user_name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
$password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
$email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
$address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

//セッションに保存された情報を表示
echo 'マイページ情報更新確認';
echo '<table>';
echo '<tr><td>氏名</td><td>', $user_name, '</td></tr>';
echo '<tr><td>メールアドレス</td><td>', $email, '</td></tr>';
echo '<tr><td>パスワード</td><td>', str_repeat('*', strlen($password)), '</td></tr>';
echo '<tr><td>住所</td><td>', $address, '</td></tr>';
echo '</table>';

// 更新画面に情報を渡すフォーム
echo '<form action="G1-3-6.php" method="post">';
echo '<input type="submit" value="更新する">';
echo '</form>';

echo '<form action="G1-3-4.php" method="post">';
echo '<input type="submit" value="戻る">';
echo '</form>';

require 'footer.php';
?>