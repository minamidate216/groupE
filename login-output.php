<?php
session_start();

require 'db-connect.php';

unset($_SESSION['admin']);

try {
    // Check if 'admin_id' and 'password' are set in $_POST
    if (isset($_POST['admin_id']) && isset($_POST['password'])) {
        $admin_id = $_POST['admin_id'];
        $password = $_POST['password'];

        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare('SELECT * FROM Admins WHERE admin_id = ? AND password = ?');
        $sql->execute([$admin_id, $password]);

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $_SESSION['admin'] = [
                'id' => $row['admin_id'],
                'name' => $row['admin_name'],
                // Do not save the password here for security reasons
            ];

            // ログインが成功した場合はリダイレクト
            header('Location: G2-2-1.php');
            exit();
        } else {
            echo 'ログイン名またはパスワードが違います。';
        }
    } else {
        echo 'エラー: ログインIDまたはパスワードが提供されていません。';
    }
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>


