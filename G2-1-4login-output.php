<?php
session_start();

require 'db-connect.php';

unset($_SESSION['admin']);

try {
    if (isset($_POST['admin_id']) && isset($_POST['password'])) {
        if (empty($_POST['admin_id']) || empty($_POST['password'])) {
            echo '<p style="color: red;">未入力項目があります。</p><br>';
            echo '<p><button onclick="location.href=\'G2-1-4login-input.php\'">戻る</button></p>';
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
                    echo '<p style="color: red;">パスワードが間違っています。</p><br>';
                    echo '<p><button onclick="location.href=\'G2-1-4login-input.php\'">戻る</button></p>';
                    exit();
                }
            } else {
                echo '<p style="color: red;">不正な入力の項目があります。</p><br>';
                echo '<p><button onclick="location.href=\'G2-1-4login-input.php\'">戻る</button></p>';
                exit(); // ログイン失敗時はここでスクリプトを終了
            }
        }
    } else {
        echo '<p style="color: red;">不正な入力の項目があります。</p>';
    }
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>
