<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<?php

if(!isset($_SESSION['admin'])){
    echo 'ログインしてください<br>';
    echo '<a href="G2-1-4-input.php">ログイン</a>';
    exit();
}

$pdo = new PDO($connect, USER, PASS);

// 注文日、ユーザーネーム、注文番号、注文詳細番号、商品名、商品画像、価格,個数
$query = $pdo->prepare("
SELECT O.order_id, OD.orderdetail_id, OD.quantity, O.date, OD.product_id, U.user_name, P.price, P.product_name, P.product_img
FROM Orders O 
JOIN OrdersDetails OD ON O.order_id = OD.order_id
JOIN Products P ON OD.product_id = P.product_id 
JOIN Users U ON O.user_id = U.user_id 
ORDER BY O.order_id
");
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// 注文IDごとにデータを整理
$orders = [];
foreach ($results as $row) {
    $order_id = $row['order_id'];
    if (!isset($orders[$order_id])) {
        $orders[$order_id] = [
            'date' => $row['date'],
            'name' => $row['user_name'],
            'details' => [],
            'total' => 0
        ];
    }
    $orders[$order_id]['details'][] = $row;
    $orders[$order_id]['total'] += $row['quantity'] * $row['price'];
}



foreach ($orders as $order_id => $order) {
    echo '<div class="content">';
    // echo '<div class="container">';
    echo '<div style="display: flex; flex-wrap: wrap";>';
    echo '<div class="card" style="width:100%";>';
    echo '<header class="card-header has-background-warning-light">';
    echo '<span class="card-header-title"><i class="far fa-calendar-alt"></i>注文日:' . $order['date'] . '</span>';
    echo '<span class="card-header-title"><i class="fas fa-sort-numeric-down"></i>注文番号:' . $order_id . '</span>';
    echo '</header>';
    echo '<div class="card-content>';
    foreach ($order['details'] as $detail) {
        // 各商品の詳細を表示
        echo '<div class="content">';
        echo '<img  src= "image/', $detail['product_img'], '" style="width:130px";>';
        echo "<span><h2>" . $detail['product_name'] . "</h2></span>";
        echo "<span><h2>単価: ¥" . $detail['price'] . "</h2></span>";
        echo "</div><hr>";    
    }
    echo '<footer class="card-footer has-background-warning-light">';
    echo '<span class="card-footer-item"><i class="fas fa-wallet"></i>合計金額:' . $order['total'] .
        ' <i class="fab fa-qq"></i>注文者:' . $order['name'] . '</span>';
    echo '</footer>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    // echo '</div>';
    echo '</div>';
}

?>


<style>
</style>
<?php require 'footer.php'; ?>