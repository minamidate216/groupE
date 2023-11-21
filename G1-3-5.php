<?php session_start(); ?>
<?php

if (isset($_POST['submit'])) {
    $_SESSION['User']['user_name'] = $_POST['user_name'];
    $_SESSION['User']['email'] = $_POST['email'];
    $_SESSION['User']['password'] = $_POST['password'];
    $_SESSION['User']['address'] = $_POST['address'];
}

$id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : '';
$name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
$mailladdress = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
$password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
$address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

echo '<p>名前: ', $user_name, '</p>';
echo '<p>メールアドレス: ', $email, '</p>';
echo '<p>パスワード: ', $password, '</p>';
echo '<p>住所: ', $address, '</p>';
?>

<form action="G1-3-6.php" method="post">
    <input type="submit" name="submit" value="更新する">
</form>
