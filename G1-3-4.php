<?php session_start();?>
<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力値を取得
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $mailladdress = isset($_POST['email']) ? $_POST['email'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // エラーメッセージ
    if (empty($user_name)) {
        $errors[] = "氏名を入力してください。";
    }
    if (empty($password)) {
        $errors[] = "パスワードを入力してください。";
    }
    if (empty($email)) {
        $errors[] = "メールアドレスを入力してください。";
    }
    if (empty($address)) {
        $errors[] = "住所を入力してください。";
    }

    // エラーがなければ次の画面に遷移
    if (empty($errors)) {
        $_SESSION['hozon']['id'] = $id;
        $_SESSION['hozon']['user_name'] = $user_name;
        $_SESSION['hozon']['password'] = $password;
        $_SESSION['hozon']['email'] = $email;
        $_SESSION['hozon']['address'] = $address;

        header("Location: G1-3-5.php");
        exit();
    }
}

?>

<!-- エラーメッセージの表示 -->
<?php if (!empty($errors)) : ?>
    <ul style="color: red;">
        <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<html lage="ja">
<!-- フォーム -->
<form action="" method="post">
    <table>
        <tr>
            <td>氏名</td>
            <td><input type="text" name="user_name"></td>
        </tr>
        <tr>
            <td>パスワード</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>住所</td>
            <td><input type="text" name="address"></td>
        </tr>
    </table>
    <!-- 送信ボタン -->
    <input type="submit" name="submit" value="次へ">
</form>
