<?php require 'header.php'; ?>
<!-- 定期購入一覧画面　定期購入編集⇨ 定期購入削除 -->
<br>
<br>
<br>


<?php
$pdo = new PDO($connect, USER, PASS);
// $productId = $_GET['id'];
// 日付の変数
$currentDateTime = date('Y-m-d H:i:s');
$minDateTime = date('Y-m-d', strtotime('+2 days'));
$maxDateTime = date('Y-m-d', strtotime('+30 days'));
// 画面に表示させるもの
$product_name = "";
$product_img = "";
$total = 0;
$totalCount = 0;



// 商品テーブルから一致するものを取得する
$subscriptionSql = $pdo->prepare('SELECT 
s.subscription_id,
s.user_id,
s.product_id,
s.interval_days,
s.next_order_date,
s.order_count,
p.product_name,
p.product_img,
p.price
FROM 
subscription_orders s
JOIN 
Products p ON s.product_id = p.product_id
WHERE 
s.user_id = ?');
$subscriptionSql->execute([$_SESSION['Users']['user_id']]);

// // 商品情報表示のための変数に格納
// foreach ($subscriptionSql as $row) {
//     $product_name =$row['product_name'];
//     $product_img =$row['product_img'];
//     $interval =$row['interval_days'];
//     $next_order_date =$row['next_order_date'];
//     $order_count =$row['order_count'];
//     $price =$row['price'];
//     $user_id =$row['user_id'];
//     $subscritpion_id =$row['subscription_id'];
//     $product_id =$row['product_id'];
//     // 確認用出力
//     echo $product_img;
//     echo $product_name;
//     echo $product_id;
//     echo '<br><p>定期ID',$subscritpion_id,'</p>';
//     echo '<p>間隔',$interval,'</p>';
//     echo '<p>日付',$next_order_date,'</p>';
//     echo '<p>価格',$price,'</p>';
?>

<div class="content">
    <div class="container is-max-desktop">
        <form action="G1-8-6.php" method="post">
            <?php
            echo '<table class="table has-background-white-ter is-hoverable">';
            echo '<thead class="has-background-success-light">';
            echo '<tr>';
            echo '<th>商品画像</th>';
            echo '<th>商品名</th>';
            echo '<th>購入個数</th>';
            echo '<th>単価</th>';
            echo '<th>次回注文日</th>';
            echo '<th>購入間隔</th>';
            echo '<th>編集</th>';
            echo '<th>削除</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($subscriptionSql as $row) {
                $product_name = $row['product_name'];
                $product_img = $row['product_img'];
                $interval = $row['interval_days'];
                $next_order_date = $row['next_order_date'];
                $order_count = $row['order_count'];
                $price = $row['price'];
                $user_id = $row['user_id'];
                $subscritpion_id = $row['subscription_id'];
                $product_id = $row['product_id'];
                $total += $price * $order_count;
                $totalCount += $order_count;
                
                echo '<tr valign="bottom" align="center">';
                echo '<td><img src="image/' . $row['product_img'] . '" style="width:50px; height:auto;"></td>';
                echo '<td align="left">' . $row['product_name'] . '</td>';
                echo '<td>' . $row['order_count'] . '個</td>';
                echo '<td valign="bottom">' . $row['price'] . '円</td>';
                echo '<td>' . $row['next_order_date'] . '</td>';
                echo '<td>' . $row['interval_days'] . '日ごと</td>';
                echo '<td><button type="submit" name="action" value="update">更新</button></td>';
                echo '<td><button type="submit" name="action" value="delete">削除</button></td>';
                echo '</tr>';

                // 画面表示及びデータベース用
                echo '<input type="hidden" name="p_id" value="', $product_id, '">';
                echo '<input type="hidden" name="name" value="', $product_name, '">';
                echo '<input type="hidden" name="img" value="', $product_img, '">';
                echo '<input type="hidden" name="interval" value="', $interval, '">';
                echo '<input type="hidden" name="next_order_date" value="', $next_order_date, '">';
                echo '<input type="hidden" name="count" value="', $order_count, '">';
                echo '<input type="hidden" name="u_id" value="', $user_id, '">';
                echo '<input type="hidden" name="s_id" value="', $subscritpion_id, '">';
            }

            echo '<tfoot>';
            // 合計金額と個数の表示
            echo '<tr valign="bottom" align="left">';
            echo '<td></td>';
            echo '<td>定期購入中の合計</td>';
            echo '<td>', $totalCount, '個の商品</td>';
            echo '<td>', $total, '円</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
            echo '</tfoot>';
            echo '</tbody>';
            echo '</table>';
            ?>

        </form>
    </div>
</div>

<?php require 'footer.php' ?>