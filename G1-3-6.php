<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
try {
    // データベースに接続
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // セッションからデータを取得
    $id = isset($_SESSION['hozon']['user_id']) ? $_SESSION['hozon']['user_id'] : '';
    $name = isset($_SESSION['hozon']['user_name']) ? $_SESSION['hozon']['user_name'] : '';
    $email = isset($_SESSION['hozon']['email']) ? $_SESSION['hozon']['email'] : '';
    $password = isset($_SESSION['hozon']['password']) ? $_SESSION['hozon']['password'] : '';
    $address = isset($_SESSION['hozon']['address']) ? $_SESSION['hozon']['address'] : '';

    // 更新用のプリペアドステートメントを使用して安全にデータベースを更新
    $stmt = $pdo->prepare("UPDATE teamE SET name = ?, mailladdress = ?, password = ?, address = ? WHERE id = ?");
    $stmt->execute([$user_name, $email, $password, $address, $id]);

    // 更新完了メッセージを表示
    echo "情報が更新されました。";
    var_dump([$user_name, $email, $password, $address, $id]);

} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
} finally {
    // データベース接続を閉じる
    $pdo = null;
}
?>
