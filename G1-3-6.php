<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // フォームから送信された情報を取得
        $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';

        $pdo->beginTransaction();

        // ユーザー情報を更新
        $stmt = $pdo->prepare("UPDATE Users SET user_name = ?, email = ?, password = ?, address = ? WHERE user_id = ?");
        $stmt->execute([$user_name, $email, $password, $address, $user_id]);

        // コミット
        $pdo->commit();
        echo '<table>';
        echo '<tr><td>ユーザーID</td><td>', $user_id, '</td></tr>';
        echo '<tr><td>氏名</td><td>', $user_name, '</td></tr>';
        echo '<tr><td>メールアドレス</td><td>', $email, '</td></tr>';
        echo '<tr><td>パスワード</td><td>', str_repeat('*', strlen($password)), '</td></tr>';
        echo '<tr><td>住所</td><td>', $address, '</td></tr>';
        echo '</table>';
        echo '更新が完了しました。';
        echo '<form action="G1-1-1.php" method="post">';
        echo '<input type="submit" value="トップへ">';
        echo '</form>';

    } catch (PDOException $e) {
        // エラーが発生するとロールバック
        $pdo->rollBack();
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo '不正なアクセスです。';
}

require 'footer.php';
?>
