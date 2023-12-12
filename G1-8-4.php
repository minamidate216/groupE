<?php require 'header.php'; ?>
<!-- 定期購入完了画面　-->
<!-- 定期購入確認画面での入力を表示
ユーザーが確認をして送信を押すとデータベースに挿入する
遷移先はトップ画面か商品一覧.php -->
<br>
<br>
<br>

<div class="content has-text-centered">
    <?php
    $pdo = new PDO($connect, USER, PASS);

    // G1-8-3=>データ⇩
    $user_id = $_SESSION['Users']['user_id'];
    $product_id = $_POST['id'];
    $product_id = intval($product_id);
    $interval = $_POST['interval'];
    $next_order_date = $_POST['next_order_date'];
    $order_count = $_POST['order_count'];
    // echo '<p>画面表示</p>';
    // echo '<p>ID: ' . $product_id . '</p>';
    

    // echo '<p>データベース用</p>';
    // echo '<p>ユーザーID: ' . $user_id . '</p>';
    // echo '<p>間隔: ' . $interval . '</p>';
    // echo '<p>次の注文日: ' . $next_order_date . '</p>';
    // echo '<p>注文数: ' . $order_count . '</p>';
    
    // G1-8-6からの値によって実行するsqlを変更する
    
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // 削除のsqlとメッセージを変数に格納
    } elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
        // 更新sqlとメッセージを変数に格納
    } else {
        // 注文のinsert文とメッセージをsqlに格納
        // 定期購入情報　⇨　定期購入テーブル
        $sql = "INSERT INTO subscription_orders (subscription_id, user_id, product_id, interval_days, next_order_date, order_count) VALUES (NULL ,?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $product_id, $interval, $next_order_date, $order_count]);

        // 挿入成功時のメッセージ
        $title =  '<h1 class="title">ご注文が完了しました。<br>
           ありがとうございます</h1>';
        $subtitle =  '<p class="subtitle">初回配送日以降に注文が確定し履歴に表示されます。</p>';
    }


    try {

        // ここにsqlを記述


    } catch (PDOException $e) {
        // エラー発生時（挿入失敗時）のメッセージ
        echo '<p>注文に失敗しました。エラー: ' . $e->getMessage() . '</p>';
    }
    ?>

</div>
<?php require 'footer.php'; ?>