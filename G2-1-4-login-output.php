<?php
session_start();

require 'db-connect.php';

unset($_SESSION['admin']);

try {
    if (isset($_POST['admin_id']) && isset($_POST['password'])) {
        if (empty($_POST['admin_id']) || empty($_POST['password'])) {
            echo '<p style="color: red; text-align: center;">未入力項目があります。</p><br>';
            echo '<p style="text-align: center;"><button onclick="location.href=\'G2-1-4-login-input.php\'">戻る</button></p>';
            exit(); // ログイン失敗時はここでスクリプトを終了
        } else {
            $admin_id = $_POST['admin_id'];
            $password = $_POST['password'];

            $pdo = new PDO($connect, USER, PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare('SELECT * FROM Admins WHERE admin_id = ?');
            $sql->execute([$admin_id]);

            $row = $sql->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['admin'] = [
                        'id' => $row['admin_id'],
                        'name' => $row['admin_name'],
                        // Do not save the password here for security reasons
                    ];
                    // ログインが成功した場合はリダイレクト
                    header('Location: G2-2-1.php');
                    exit();
                } else {
                    echo '<p style="color: red; text-align: center;">パスワードが間違っています。</p><br>';
                    echo '<div style="text-align: center;">
                    <p><a href="G2-1-4-login-input.php" ><button type="button"class="button is-primary">ログイン画面へ</button></a></p> 
                    </div>';
                    exit();
                }
            } else {
                echo '<p style="color: red; text-align: center;">不正な入力の項目があります。</p><br>';
                echo '<div style="text-align: center;">
                <p><a href="G2-1-4-login-input.php" ><button type="button"class="button is-primary">ログイン画面へ</button></a></p> 
                </div>';
                exit(); // ログイン失敗時はここでスクリプトを終了
            }
        }
    } else {
        echo '<p style="color: red; text-align: center;">不正な入力の項目があります。</p>';
    }
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
    p {
            color: #4CAF50; /* 薄緑色 */
            margin: 10px 0;
        }
    </style>
    <title>Document</title>
</head>
<body>
</body>
</html>
