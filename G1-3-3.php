<?php require 'header.php'; ?>
<?php
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
            echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">';
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">';
echo '<div class="content">';
    echo '<div class="container">';
        echo '<div class="has-text-centered">';
            echo '<h3>マイページ</h3>';
        echo '</div>';
            echo '<form action="G1-3-4.php" method="post">';
            echo '<table>';
            echo '<tr class="column is-half is-offset-4"><td class="has-text-primary-dark">氏名　　　　　　</td><td>', $user['user_name'], '</td></tr>';
            echo '<tr class="column is-half is-offset-4"><td class="has-text-primary-dark">メールアドレス　</td><td>', $user['email'], '</td></tr>';
            echo '<tr class="column is-half is-offset-4"><td class="has-text-primary-dark">パスワード　　　</td><td>', str_repeat('*', strlen($user['password'])), '</td></tr>';
            echo '<tr class="column is-half is-offset-4"><td class="has-text-primary-dark">住所　　　　　　</td><td>', $user['address'], '</td></tr>';
            
            echo '</table>';
            echo '<div class="has-text-centered">';
            echo '<input class="button is-primary-dark" type="submit" value="登録内容をを変更する">';
            echo '</div>';
            echo '</form>';
        echo '</div>';
    echo '</div>';
echo '</div>';
        } else {
            echo 'ログインしてください。';
        }

    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
} else {
    echo 'ログインしてください。';
}
?>