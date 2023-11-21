<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
try {
    // データベースに接続
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // セッションからデータを取得
    $id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : '';
    $name = isset($_SESSION['User']['user_name']) ? $_SESSION['User']['user_name'] : '';
    $email = isset($_SESSION['User']['email']) ? $_SESSION['User']['email'] : '';
    $password = isset($_SESSION['User']['password']) ? $_SESSION['User']['password'] : '';
    $address = isset($_SESSION['User']['address']) ? $_SESSION['User']['address'] : '';

    // 更新用のプリペアドステートメントを使用して安全にデータベースを更新
    $stmt = $pdo->prepare("UPDATE Users SET user_name = ?, email = ?, password = ?, address = ? WHERE user_id = ?");
    $stmt->execute([$user_name, $email, $password, $address, $id]);

    // 更新完了メッセージを表示
    echo "情報が更新されました。";
    var_dump([$user_name, $email, $password, $address, $user_id]);

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    $pdo = null;
}
?>
