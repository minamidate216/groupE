<?php require 'header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // フォームから送信された情報を取得
        $user_id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : '';
        $user_name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
        $email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
        $password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
        $address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

        $pdo->beginTransaction();

        // ユーザー情報を更新
        $stmt = $pdo->prepare("UPDATE Users SET user_name = ?, email = ?, password = ?, address = ? WHERE user_id = ?");
        $stmt->execute([$user_name, $email, $password, $address, $user_id]);

        // コミット
        $pdo->commit();
        echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">';
        echo '<div class="content">';
        echo '<div class="container is-fluid">';
        echo '<div class="has-text-centered">';
        echo '<h3>更新が完了しました。</h3>';
        echo '</div>';
        echo '<br>';
        echo '<form action="G1-1-1.php" method="post">';
        echo '<div class="has-text-centered">';
        echo '<input class="button is-primary" type="submit" value="トップへ">';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';

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