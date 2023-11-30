<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>

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

    // 登録完了メッセージを表示
    echo "登録が完了しました。";
    echo '<form action="G1-2-1.php" method="post">';
    echo '<input type="submit" value="トップへ">';
    echo '</form>';
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
    // データベース接続を閉じる
    $pdo = null;
}
?>
