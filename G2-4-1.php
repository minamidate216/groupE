<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>


<?php
$pdo = new PDO($connect, USER, PASS);

// 注文日、ユーザーネーム、注文番号、注文詳細番号、商品名、商品画像、価格❎個数
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
    echo '<div class="container is-fluid">';
    echo '<div class="card">';
    echo '<header class="card-header">';
    echo '<span class="card-header-title"><i class="far fa-calendar-alt"></i>注文日:' . $order['date'] . '</span>';
    echo '<span class="card-header-title"><i class="fas fa-wallet"></i>合計金額:' . $order['total'] . '</span>';
    echo '<span class="card-header-title"><i class="fab fa-qq"></i>注文者:' . $order['name'] . '</span>';
    echo '<span class="card-header-title"><i class="fas fa-sort-numeric-down"></i>注文番号:' . $order_id . '</span>';
    echo '</header>';
    echo '<div class="card-content>';

    foreach ($order['details'] as $detail) {
        // 各商品の詳細を表示
        echo '<div class="content">';
        echo '<img src= "image/', $detail['product_img'], '" style="width: 100px";>';
        echo "<span><strong>" . $detail['product_name'] . "</strong></span>";
        echo "<span>単価: ¥" . $detail['price'] . "</p></span>";
        echo "</div><hr><hr>";
    }

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

?>


<style>
   
</style>
<?php require 'footer.php'; ?>