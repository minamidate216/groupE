<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
$connect = new PDO($connect,USER,PASS);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "ログイン名とパスワードを入力してください<br>";
    } else {
        // ここでログイン処理を実行
        // 例: データベースと照合したり、認証を行ったりする
        // 以下は仮の例
        if ($username === "user_name" && $password === "password") {
            echo "ログイン成功！";
            $_SESSION['user_name'] = $username; // セッションにユーザー名を保存
        } else {
            echo "ユーザー名またはパスワードが違います<br>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">ログイン名：</label>
        <input type="text" name="user_name" id="user_name"><br><br>
        <label for="password">パスワード：</label>
        <input type="password" name="password" id="password"><br><br>
        <a href="G2-2-1.php">ログイン</a>
        <a href="G2-1-1.php">新規登録</a>
    </form>
</body>
</html>
