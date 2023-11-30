<?php
session_start();
require 'db-connect.php';

// 商品IDが渡されていない場合はエラー表示
if (!isset($_GET['product_id'])) {
    die('商品IDが指定されていません。');
}

$productId = $_GET['product_id'];

try {
    $connect = new PDO($connect, USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // データベースから商品を削除
    $query = "DELETE FROM Products WHERE product_id = :product_id";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':product_id', $productId);
    $stmt->execute();

    // 削除完了後、リダイレクト
    header('Location: G2-3-6.php?delete_success=1&product_id=' . $productId);
    exit();
} catch (PDOException $e) {
    die('データベースエラー: ' . $e->getMessage());
}
?>
<a href="G2-2-1.php">戻る</a>
