<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
$errors = [];

$password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
$email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
$address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力値を取得
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // 入力項目のチェック
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //名前の重複チェック
    $check_name = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE user_name = ?');
    $check_name->execute([$user_name]);
    $check_name_count = $check_name->fetchColumn();
    if ($check_name_count > 0) {
        $errors[] = '入力された名前は既に使用されています。';
    }
    //emilの重複チェック
    $check_email = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE email = ?');
    $check_email->execute([$email]);
    $check_email_count = $check_email->fetchColumn();
    if ($check_email_count > 0) {
        $errors[] = '入力されたメールアドレスは既に使用されています。';
    }   
    if (empty($user_name)) {
        $errors[] = '氏名を入力してください。';
    }
    if (empty($email)) {
        $errors[] = 'メールアドレスを入力してください。';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = '正しい形式のメールアドレスを入力してください。';
    }
    if (empty($password)) {
        $errors[] = 'パスワードを入力してください。';
    }
    if (empty($address)) {
        $errors[] = '住所を入力してください。';
    }

    // エラーがなければ次の処理へ
    if (empty($errors)) {
        $_SESSION['User']['user_name'] = $user_name;
        $_SESSION['User']['password'] = $password;
        $_SESSION['User']['email'] = $email;
        $_SESSION['User']['address'] = $address;
        header('Location: G1-2-5.php');
        exit;
    }
}
?>
<?php require 'header.php'; ?>
<?php
echo '<form action="" method="post">';
echo '<h3>会員登録</h3>';
echo '<table>';
echo '<tr>';
echo '<td>氏名</td>';
echo '<td><input type="text" name="user_name" value="' . $user_name . '"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>メールアドレス</td>';
echo '<td><input type="text" name="email" value="' . $email . '"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>パスワード</td>';
echo '<td><input type="password" name="password" value="' . $password . '"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>住所</td>';
echo '<td><input type="text" name="address" value="' . $address . '"></td>';
echo '</tr>';
echo '</table>';

if (!empty($errors)) {
    echo '<ul style="color: red;">';
    foreach ($errors as $error) {
        echo '<li>', $error, '</li>';
    }
    echo '</ul>';
}

echo '<input type="submit" name="submit" value="次へ">';
echo '</form>';
?>
