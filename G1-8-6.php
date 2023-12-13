<?php require 'header.php' ?>
<!-- 定期購入のアイコン -->
<br>
<br>
<?php
$subscription_id = $_POST['s_id'];
$user_id = $_POST['u_id'];
$product_id = $_POST['p_id'];
$product_name = $_POST['name'];
$product_img = $_POST['img'];
$interval = $_POST['interval'];
$next_order_date = $_POST['next_order_date'];
$order_count = $_POST['count'];



$currentDateTime = date('Y-m-d H:i:s');
$minDateTime = date('Y-m-d', strtotime('+2 days'));
// 次回配送日の計算
$date = new DateTime($next_order_date);
// 間隔を加算
// Max日付を変数に格納（Y-m-d形式で）
$date->modify('+' . 30 . ' days');
$maxDateTime = $date->format('Y-m-d');

if ($minDateTime > $next_order_date) {
    $minDateTime = $next_order_date;
}


// echo '<p>画面表示</p>';
// echo '<p>ID:' . $product_id . '</p>';
// echo '<p>S_ID:' . $subscription_id . '</p>';
// echo '<p>U_ID:' . $user_id . '</p>';
// echo '<p>名前: ' . $product_name . '</p>';
// echo '<p>画像: <img src="image/' . $product_img . '" alt="画像" style="width: 100px";></p>';
// // 画面表示に使う変数





// echo '<p>データベース用</p>';
// echo '<p>ユーザーID: ' . $user_id . '</p>';
// echo '<p>間隔: ' . $interval . '</p>';
// echo '<p>次の注文日: ' . $next_order_date . '</p>';
// echo '<p>注文数: ' . $order_count . '</p>';

echo '<div class="content">';
echo '<div class="has-text-centered">';
echo '<form action="G1-8-4.php" method="post" class="box" style="margin: 0 auto; width: 30%";>';

if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    // 削除の処理
    echo '        <h1>定期購入解約内容</h1>';
    echo '            <div class="card">';
    echo '                <header class="card-header has-text-centered">';
    echo '                    <span class="card-header-icon"><i class="fas fa-cube"></i>';
    echo '                        </span>';
    echo '                    <p class="card-header-title has-text-success-dark">';
    echo $product_name;
    echo '                    </p>';
    echo '                </header>';
    echo '                <div class="card-image">';
    echo '                    <figure class="image is-128x128" style="margin: 0 auto";>';
    echo '                        <img src="image/', $product_img, '" alt="イメージ">';
    echo '                    </figure>';
    echo '                </div>';
    echo '                <div class="card-content">';
    echo '                    <div class="content">';
    echo '                        <div class="field">';
    echo '                            <label class="label"><strong>定期購入間隔</strong></label>';
    echo '                            <div class="control"><p class="subtitle">', $interval, '日間ごと</p></div></div>';
    echo '                        <div class="field">';
    echo '                            <label class="label"><strong>定期購入次回配送日</strong></label>';
    echo '                            <div class="control" style="margin: 0 auto";>';
    echo '<p class="subtitle">', $next_order_date, '</p>';
    echo '                            </div>';
    echo '                        </div>';
    echo '                        <br><br>';
    echo '                        <div class="field">';
    echo '                            <label class="label"><strong>定期購入個数</strong></label>';
    echo '                            <div class="control">';
    echo '<p class="subtitle">', $order_count, '個</p>';
    echo '                            </div>';
    echo '                        </div>';
    echo '                        <br><br>';
    echo '                            <p class="help has-text-warning-dark">解約申し込みをキャンセルされる方は<br>
                                                            下記の商品一覧のリンクをクリックして下さい</p>';
    echo ' <a class="help has-text-success-dark" href="G1-5-1.php">商品一覧へ<span class="icon">';
    echo '                            <i class="fas fa-reply"></i></span></a>';
    echo '                    </div>';
    echo '                </div>';
    echo '                <footer class="card-footer has-background-success-dark">';
    echo '                    <button class="card-footer-item" type="submit" name="action" value="delete">解約確定<span class="icon is-small"><i';
    echo '                                class="fas fa-shopping-cart"></i></span></button>';
    echo '                </footer>';
    echo '            </div>';
    echo '<input type="hidden" name="p_id" value="', $product_id, '">';
    echo '<input type="hidden" name="name" value="', $product_name, '">';
    echo '<input type="hidden" name="img" value="', $product_img, '">';
    echo '<input type="hidden" name="interval" value="', $interval, '">';
    echo '<input type="hidden" name="next_order_date" value="', $next_order_date, '">';
    echo '<input type="hidden" name="count" value="', $order_count, '">';
    echo '<input type="hidden" name="u_id" value="', $user_id, '">';
    echo '<input type="hidden" name="s_id" value="', $subscription_id, '">';
    echo '    </div>';
    echo '</div>';
} elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
    // 更新の処理
    echo '        <h1>定期購入編集申込</h1>';
    echo '            <div class="card">';
    echo '                <header class="card-header has-text-centered">';
    echo '                    <span class="card-header-icon"><i class="fas fa-cube"></i>';
    echo '                        </span>';
    echo '                    <p class="card-header-title ">';
    echo $product_name;
    echo '                    </p>';
    echo '                </header>';
    echo '                <div class="card-image">';
    echo '                    <figure class="image is-128x128" style="margin: 0 auto";>';
    echo '                        <img src="image/', $product_img, '" alt="イメージ">';
    echo '                    </figure>';
    echo '                </div>';
    echo '                <div class="card-content">';
    echo '                    <div class="content">';
    echo '                        <div class="field">';
    echo '                            <label class="label"><strong>定期購入間隔</strong></label>';
    echo '                            <div class="control">';
    echo '                                <input type="text" name="interval" list="dateList" required>';
    echo '                                <datalist id="dateList">';
    echo '                                    <option value=10></option>';
    echo '                                    <option value=20></option>';
    echo '                                    <option value=30></option>';
    echo '                                </datalist>';
    echo '                            </div>';
    echo '                            <p class="help has-text-success-dark">10日間隔でお選びいただけます</p>';
    echo '                        </div>';
    echo '                        <div class="field">';
    echo '                            <label class="label"><strong>定期購入開始日</strong></label>';
    echo '                            <div class="control" style="margin: 0 auto";>';
    echo '                                <input type="date" style="width:120px"; name="next_order_date" min=', $minDateTime, ' max=', $maxDateTime, ' required>';
    echo '                            </div>';
    echo '                            <p class="help has-text-success-dark">2日後もしくは次回配送日以降からお選びいただけます</p>';
    echo '                        </div>';
    echo '                        <br><br>';
    echo '                        <div class="field">';
    echo '                            <label class="label"><strong>定期購入個数</strong></label>';
    echo '                            <div class="control">';
    echo '                                <input type="number" name="order_count" min=5 max=10 required>';
    echo '                            </div>';
    echo '                            <p class="help has-text-success-dark">5〜10個まで選択できます</p>';
    echo '                        </div>';
    echo '                        <br><br>';
    echo '                            <p class="help has-text-warning-dark">編集申し込みをキャンセルされる方は<br>
                                                            下記の商品一覧のリンクをクリックして下さい</p>';
    echo ' <a class="help has-text-success-dark" href="G1-5-1.php">商品一覧へ<span class="icon">';
    echo '<i class="fas fa-reply"></i></span></a>';
    echo '                    </div>';
    echo '                </div>';
    echo '                <footer class="card-footer">';
    echo '                    <button class="card-footer-item" type="submit" name="action" value="update">編集確定<span class="icon is-small"><i';
    echo '                                class="fas fa-shopping-cart"></i></span></button>';
    echo '                </footer>';
    echo '            </div>';
    echo '<input type="hidden" name="p_id" value="', $product_id, '">';
    echo '<input type="hidden" name="name" value="', $product_name, '">';
    echo '<input type="hidden" name="img" value="', $product_img, '">';
    echo '<input type="hidden" name="u_id" value="', $user_id, '">';
    echo '<input type="hidden" name="s_id" value="', $subscription_id, '">';
    echo '        </form>';
    echo '    </div>';
    echo '</div>';
}

?>