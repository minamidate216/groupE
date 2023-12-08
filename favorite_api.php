<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
// JSON形式のデータを受け取る
$data = json_decode(file_get_contents('php://input'), true);
// データを変数に格納
$productId = $data['productId'];
$isFavorited = $data['isFavorite'];
$userId = $_SESSION['Users']['user_id']; // ユーザーID
// データベースへの接続
$pdo = new PDO($connect, USER, PASS);
// お気に入りの追加または削除の処理
if ($isFavorited) {
    // お気に入り追加
    $stmt = $pdo->prepare("INSERT INTO Favorites (user_id, product_id) VALUES (?, ?)");
    $stmt->execute([$userId, $productId]);
    $result = 'お気に入りリストに登録しました。';
    
} else {
    // お気に入り削除
    $stmt = $pdo->prepare("DELETE FROM Favorites WHERE user_id=? AND product_id=?");
    $stmt->execute([$userId, $productId]);
    $result = 'お気に入りリストから削除しました。';
}
// 応答
echo json_encode(['status' => $result]);
?>