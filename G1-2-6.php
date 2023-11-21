<?php session_start(); ?>
<?php require 'db-connect.php'; ?>

<?php
try {
    // データベースに接続
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // セッションからデータを取得
    $user_.name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
    $mailladdress = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
    $password = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
    $address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

    // プリペアドステートメントを使用して安全にデータベースに挿入
    $stmt = $pdo->prepare("INSERT INTO Users (user_name, password, email, address) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_name, $password, $password, $address]);

    // 登録完了メッセージを表示
    echo "登録が完了しました。";

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    $pdo = null;
}
?>
