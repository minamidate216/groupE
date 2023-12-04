<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
//フォームの情報を取得
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

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
echo '<input type="hidden" name="user_id" value="', $user_id, '">';
echo '<input type="hidden" name="user_name" value="', $user_name, '">';
echo '<input type="hidden" name="email" value="', $email, '">';
echo '<input type="hidden" name="password" value="', $password, '">';
echo '<input type="hidden" name="address" value="', $address, '">';
echo '<input type="submit" value="更新する">';
echo '</form>';

echo '<form action="G1-3-4.php" method="post">';
echo '<input type="submit" value="戻る">';
echo '</form>';

require 'footer.php';
?>
