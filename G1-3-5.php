<?php session_start(); ?>
<?php

if (isset($_POST['submit'])) {
    $_SESSION['hozon']['user_name'] = $_POST['user_name'];
    $_SESSION['hozon']['email'] = $_POST['email'];
    $_SESSION['hozon']['password'] = $_POST['password'];
    $_SESSION['hozon']['address'] = $_POST['address'];
}

$id = isset($_SESSION['hozon']['id']) ? $_SESSION['hozon']['id'] : '';
$name = isset($_SESSION['hozon']['user_name']) ? $_SESSION['hozon']['user_name'] : '';
$mailladdress = isset($_SESSION['hozon']['email']) ? $_SESSION['hozon']['email'] : '';
$password = isset($_SESSION['hozon']['password']) ? $_SESSION['hozon']['password'] : '';
$address = isset($_SESSION['hozon']['address']) ? $_SESSION['hozon']['address'] : '';

echo '<p>名前: ', $user_name, '</p>';
echo '<p>メールアドレス: ', $email, '</p>';
echo '<p>パスワード: ', $password, '</p>';
echo '<p>住所: ', $address, '</p>';
?>

<form action="G1-3-6.php" method="post">
    <input type="submit" name="submit" value="更新する">
</form>
