<?php
require 'header.php';
require 'db-connect.php';

// セッションからユーザーIDを取得
$user_id = isset($_SESSION['Users']['user_id']) ? $_SESSION['Users']['user_id'] : null;

if ($user_id) {
    try {
        // データベースに接続
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ユーザーIDを使用してデータベースからユーザー情報を取得
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // ユーザー情報を表示
            echo 'マイページ';
            echo '<form action="G1-3-4.php" method="post">';
            echo '<table>';
            echo '<tr><td>ユーザーID</td><td>', $user['user_id'], '</td></tr>';
            echo '<tr><td>氏名</td><td>', $user['user_name'], '</td></tr>';
            echo '<tr><td>メールアドレス</td><td>', $user['email'], '</td></tr>';
            echo '<tr><td>パスワード</td><td>', str_repeat('*', strlen($user['password'])), '</td></tr>';
            echo '<tr><td>住所</td><td>', $user['address'], '</td></tr>';
            echo '</table>';
            echo '<input type="submit" value="登録内容をを変更する">';
            echo '</form>';
        } else {
            echo 'ユーザーが見つかりません。';
        }

    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo 'ユーザーIDが保存されていません。';
}
?>
