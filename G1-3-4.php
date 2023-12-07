<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
$user_id = isset($_SESSION['Users']['user_id']) ? $_SESSION['Users']['user_id'] : null;
$errors = [];

if ($user_id) {
    try {
        // データベースに接続
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ユーザーIDを使用してデータベースからユーザー情報を取得
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // フォームが送信された場合の処理
        if (isset($_POST['confirm'])) {
            $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : $user['user_name'];
            $email = isset($_POST['email']) ? $_POST['email'] : $user['email'];
            $password = isset($_POST['password']) ? $_POST['password'] : $user['password'];
            $address = isset($_POST['address']) ? $_POST['address'] : $user['address'];

            // ユーザー名の重複チェック
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE user_id != ? and user_name = ?");
            $stmt->execute([$user_id, $user_name]);
            $userNameCount = $stmt->fetchColumn();
            if ($userNameCount > 0) {
                $errors[] = "このユーザー名は既に使用されています。";
            }

            // メールアドレスの重複チェック
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Users WHERE user_id != ? and email = ?");
            $stmt->execute([$user_id, $email]);
            $emailCount = $stmt->fetchColumn();

            if ($emailCount > 0) {
                $errors[] = "このメールアドレスは既に使用されています。";
            }
            // 未入力の項目があるか確認
            if (empty($user_name)) {
                $errors[] = "氏名を入力してください。";
            }else if (mb_strlen($user_name, 'UTF-8') > 20) {
                $errors[] = '氏名は20文字以内で入力してください。';
            }
            if (empty($password)) {
                $errors[] = "パスワードを入力してください。";
            }else if (strlen($password) > 20) {
                $errors[] = 'パスワードは20文字以下で入力してください。';
            }
            if (empty($email)) {
                $errors[] = "メールアドレスを入力してください。";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "正しい形式のメールアドレスを入力してください。";
            }
            if (empty($address)) {
                $errors[] = "住所を入力してください。";
            }else if (mb_strlen($address, 'UTF-8') > 50) {
                $errors[] = '住所は50文字以内で入力してください。';
            }

            if (empty($errors)) {
                // エラーがなければ次の画面に遷移
                $_SESSION['User']['user_name'] = $user_name;
                $_SESSION['User']['password'] = $password;
                $_SESSION['User']['email'] = $email;
                $_SESSION['User']['address'] = $address;
                header('Location: G1-3-5.php');
                exit;
            }
        }
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo 'ユーザーIDが保存されていません。';
}
?>
<?php require 'header.php';?>
<?php
if ($user) {
    // 更新前のユーザー情報を表示
    echo 'マイページ情報変更';
    echo '<form action="" method="post">';
    if (!empty($errors)) {
        echo '<ul style="color: red;">';
        foreach ($errors as $error) {
            echo '<li>', $error, '</li>';
        }
        echo '</ul>';
    }
    echo '<table>';
    echo '<input type="hidden" name="user_id" value="', $user_id, '">';
    echo '<tr><td>氏名</td><td><input type="text" name="user_name" value="', $user['user_name'], '"></td></tr>';
    echo '<tr><td>メールアドレス</td><td><input type="text" name="email" value="', $user['email'], '"></td></tr>';
    echo '<tr><td>パスワード</td><td><input type="password" name="password" value="', $user['password'], '"></td></tr>';
    echo '<tr><td>住所</td><td><input type="text" name="address" value="', $user['address'], '"></td></tr>';
    echo '</table>';

    echo '<input type="submit" value="確認する" name="confirm">';
    echo '</form>';
} else {
    echo 'ユーザーが見つかりません。';
}
require 'footer.php';
?>