<?php session_start(); ?>
<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力値を取得
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // エラーメッセージ
    if (empty($user_name)) {
        $errors[] = "氏名を入力してください。";
    }
    if (empty($password)) {"パスワードを入力してください。";
    }
        $errors[] = 
    }
    if (empty($email)) {
        $errors[] = "メールアドレスを入力してください。";
    if (empty($address)) {
        $errors[] = "住所を入力してください。";
    }

    // エラーがなければ次の画面に遷移
    if (empty($errors)) {
        $_SESSION['User']['user_name'] = $user_name;
        $_SESSION['User']['password'] = $password;
        $_SESSION['User']['email'] = $email;
        $_SESSION['User']['address'] = $address;

        header("Location: G1-2-5.php");
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

<!-- フォーム -->
<form action="" method="post">
    <table>
        <tr>
            <td>氏名</td>
            <td><input type="text" name="user_name"></td>
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>パスワード</td>
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
