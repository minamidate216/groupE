<?php require 'header.php'; ?>
<?php
try {
    // データベースに接続
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // セッションからデータを取得
    $user_name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
    $email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
    $password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
    $address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

    // プリペアドステートメントを使用してデータベースに挿入
    $stmt = $pdo->prepare("INSERT INTO Users (user_name, email, password, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_name, $email, $password, $address]);
    echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">';
    // 登録完了メッセージを表示
    echo '<div class="content">';
    echo '<div class="container is-fluid">';
    echo '<div class="has-text-centered">';
    echo '<h3>会員登録が完了しました。</h3>';
    echo '</div>';
    echo '<br>';
    echo '<form action="G1-1-1.php" method="post">';
    echo '<div class="has-text-centered">';
    echo '<input class="button is-primary-dark" type="submit" value="トップへ">';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
    // データベース接続を閉じる
    $pdo = null;
}
?>