<?php require 'header.php'; ?>
<!-- 定期購入確認画面　-->
<!-- 定期購入確認画面での入力を表示
ユーザーが確認をして送信を押すとデータベースに挿入する
遷移先はG1-8-3.php -->
<br>
<br>
<br>


<?php
$pdo = new PDO($connect, USER, PASS);

$user_id = $_SESSION['Users']['user_id'];
$product_id =$_POST['id'];
$product_name = $_POST['name'];
$product_img = $_POST['img'];
$interval = $_POST['interval'];
$next_order_date = $_POST['next_order_date'];
$order_count = $_POST['order_count'];
// 次回配送日の計算
$date = new DateTime($next_order_date);
// 間隔を加算
$date->modify('+' . $interval . ' days');
// 新しい日付を変数に格納（Y-m-d形式で）
$updated_date = $date->format('Y-m-d');


// echo '<p>画面表示</p>';
// echo '<p>ID:' . $product_id . '</p>';
// echo '<p>名前: ' . $product_name . '</p>';
// echo '<p>画像: <img src="image/' . $product_img . '" alt="画像" style="width: 100px";></p>';


// echo '<p>データベース用</p>';
// echo '<p>ユーザーID: ' . $user_id . '</p>';
// echo '<p>間隔: ' . $interval . '</p>';
// echo '<p>次の注文日: ' . $next_order_date . '</p>';
// echo '<p>注文数: ' . $order_count . '</p>';

?>


<form action="G1-8-4.php" method="post" class="box" style="margin: 0 auto; width: 30%";>
<?php

echo '<div class="content">';
echo '<div class="has-text-centered">';
echo '        <h1>定期購入確認画面</h1>';
echo '            <div class="card">';
echo '                <header class="card-header has-text-centered">';
echo '                    <span class="card-header-icon"><i class="fas fa-cube"></i>';
echo '                        </span>';
echo '                    <p class="card-header-title has-text-success-dark">';
echo                            $product_name;
echo '                    </p>';
echo '                </header>';
echo '                <div class="card-image">';
echo '                    <figure class="image is-128x128" style="margin: 0 auto";>';
echo '                        <img src="image/',$product_img, '" alt="イメージ">';
echo '                    </figure>';
echo '                </div>';
echo '                <div class="card-content">';
echo '                    <div class="content">';
echo '                        <div class="field">';
echo '                            <label class="label"><strong>定期購入間隔</strong></label>';
echo '                            <div class="control"><p class="subtitle">',$interval,'日間ごと</p></div></div>';
echo '                        <div class="field">';
echo '                            <label class="label"><strong>定期購入開始日</strong></label>';
echo '                            <div class="control" style="margin: 0 auto";>';
echo                                   '<p class="subtitle">初回配送日', $next_order_date ,'</p>';
echo                                   '<p class="help">次回配送日', $updated_date ,'</p>';
echo '                            </div>';
echo '                        </div>';
echo '                        <br><br>';
echo '                        <div class="field">';
echo '                            <label class="label"><strong>定期購入個数</strong></label>';
echo '                            <div class="control">';
echo                                   '<p class="subtitle">',$order_count,'個</p>';
echo '                            </div>';
echo '                        </div>';
echo '                        <br><br>';
echo '                            <p class="help has-text-warning-dark">申し込みをキャンセルされる方は<br>
                                                            下記の商品一覧のリンクをクリックして下さい</p>';
                            echo ' <a class="help has-text-success-dark" href="G1-5-1.php">商品一覧へ<span class="icon">';
                            echo '                            <i class="fas fa-reply"></i></span></a>';
echo '                    </div>';
echo '                </div>';
echo '                <footer class="card-footer has-background-success-dark">';
echo '                    <button class="card-footer-item">申込確定<span class="icon is-small"><i';
echo '                                class="fas fa-shopping-cart"></i></span></button>';
echo '                </footer>';
echo '            </div>';
echo                '<input type="hidden" name="id" value="',$product_id,'">';
echo                '<input type="hidden" name="name" value="',$product_name,'">';
echo                '<input type="hidden" name="img" value="',$product_img,'">';
echo                '<input type="hidden" name="interval" value="',$interval,'">';
echo                '<input type="hidden" name="next_order_date" value="',$next_order_date,'">';
echo                '<input type="hidden" name="order_count" value="',$order_count,'">';
echo '    </div>';
echo '</div>';
?>
</form>

<?php require 'footer.php' ?>

