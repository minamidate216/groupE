<?php require 'header.php'; ?>

<?php
if (empty($_SESSION['Users'])) {
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
} else {
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->prepare('SELECT COUNT(p.product_id), p.description, p.product_img, o.order_id, o.date, p.product_id, p.product_name, p.price, od.quantity FROM Orders AS o JOIN OrdersDetails AS od ON o.order_id = od.order_id LEFT OUTER JOIN Products AS p ON od.product_id = p.product_id WHERE o.user_id = ? GROUP BY o.order_id ORDER BY o.order_id DESC');
    $sql->execute([$_SESSION['Users']['user_id']]);
    if ($sql->rowCount() > 0) {
        foreach ($sql as $row) {
            $date = date('Y-m-d', strtotime($row['date']));
            $price = $row['price'] * $row['quantity'];

            echo '<div class="columns">';
            echo '<div class="container">';
            echo '<div class="column">';
            echo '<table class="table is-striped column has-background-white-ter">';
            echo '<tr class="b-noBottom has-background-success"><th style="width: 20%">注文番号：', $row['order_id'], '</th><th></th><th style="width: 40%">購入日：', $date, '</th><th></th><th></th></tr>';
            echo '<tr class="b-noTop has-background-white-ter">';
            echo '<td>';
            echo '<img alt="image" width="100" height="100" src="image/', $row['product_img'], '"></a></td>';
            echo '<td></td>';
            echo '<td style="has-text-centered"  class="textBr is-vcentered">', $row['product_name'];
            if ($row['COUNT(p.product_id)'] > 1) {
                echo 'など', $row['COUNT(p.product_id)'], '点';
            }
            echo '</td>';
            echo '<td></td>';
            echo '<td class="is-vcentered">';
            echo '<form action="G1-7-2.php" method="get">';
            echo '<input type="hidden" name=orderId value="', $row['order_id'], '">';
            echo '<input type="hidden" name=Date value="', $date, '">';
            echo '<button type="submit">詳細を表示</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '過去の注文履歴がありません。';
    }
}
?>
<style>
    table {
        margin: auto 225px auto;
        box-shadow: 0 10px 25px 0 rgba(0, 0, 0, .5);

    }

    /* .b-noBottom {
        border-right: 2px solid #adffad;
        border-top: 2px solid #adffad;
        border-left: 2px solid #adffad;
    }

    .b-noTop {
        border-right: 2px solid #adffad;
        border-bottom: 2px solid #adffad;
        border-left: 2px solid #adffad;
    } */

    .textBr {
        width: 320px;
    }
</style>
<?php require 'footer.php'; ?>