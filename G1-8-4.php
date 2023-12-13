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
    $title= "";
    $subtitle= "";
    $button ="";


    // G1-8-3=>データ⇩
    
    // echo '<p>画面表示</p>';
    // echo '<p>ID: ' . $product_id . '</p>';
    

    // echo '<p>データベース用</p>';
    // echo '<p>ユーザーID: ' . $user_id . '</p>';
    // echo '<p>間隔: ' . $interval . '</p>';
    // echo '<p>次の注文日: ' . $next_order_date . '</p>';
    // echo '<p>注文数: ' . $order_count . '</p>';
    
    // G1-8-6からの値によって実行するsqlを変更する
    try {


        if (isset($_POST['action']) && $_POST['action'] === 'delete') {
            // 削除のsqlとメッセージを変数に格納
            $user_id = $_POST['u_id'];
            $product_id = $_POST['p_id'];
            $subscription_id = $_POST['s_id'];
            $order_count = $_POST['count'];

            $sql = "DELETE FROM subscription_orders
         where subscription_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$subscription_id]);

            $title = '<h1 class="title">解約が完了しました。<br>
           ありがとうございました。</h1>';
            $subtitle = '<p class="subtitle"><a class="button is-outlined" href="G1-8-5.php">定期購入一覧で確認する</a></p>';

        } elseif (isset($_POST['action']) && $_POST['action'] === 'update') {
            // 更新sqlとメッセージを変数に格納
            // $user_id = $_POST['u_id'];
            // $product_id = $_POST['p_id'];
            $subscription_id = $_POST['s_id'];
            $interval = $_POST['interval'];
            $next_order_date = $_POST['next_order_date'];
            $order_count = $_POST['order_count'];
            echo $subscription_id,'<br>';
            echo $interval,'<br>';
            echo $next_order_date,'<br>';
            echo $order_count,'<br>';

            $sql = 'UPDATE subscription_orders SET 
            interval_days = ?, next_order_date = ?, order_count = ?
             WHERE subscription_id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$interval,$next_order_date,$order_count,$subscription_id]);

            $title = '<h1 class="title">定期内容の変更が完了しました。<br>
           ありがとうございます</h1><br>';
            $subtitle = '<p class="subtitle">これからもよろしくお願いいたします。</p>';
            $button = '<p class="subtitle"><a class="button is-outlined" href="G1-8-5.php">定期購入一覧で確認する</a></p>';


        } else {
            // 注文のinsert文とメッセージをsqlに格納
            // 定期購入情報　⇨　定期購入テーブル
            $user_id = $_SESSION['Users']['user_id'];
            $product_id = $_POST['id'];
            $interval = $_POST['interval'];
            $next_order_date = $_POST['next_order_date'];
            $order_count = $_POST['order_count'];
            $sql = "INSERT INTO subscription_orders (subscription_id,
         user_id, product_id, interval_days, next_order_date, order_count) VALUES (NULL ,?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$user_id, $product_id, $interval, $next_order_date, $order_count]);

            // 挿入成功時のメッセージ
            $title = '<h1 class="title">ご注文が完了しました。<br>
           ありがとうございます</h1>';
            $subtitle = '<p class="subtitle">初回配送日以降に注文が確定し履歴に表示されます。</p>';
            $button = '<p class="subtitle"><a class="button is-outlined" href="G1-8-5.php">定期購入一覧で確認する</a></p>';
        }

    } catch (PDOException $e) {
        // エラー発生時（挿入失敗時）のメッセージ
        echo '<p>注文に失敗しました。エラー: ' . $e->getMessage() . '</p>';
    }
    ?>
    <?php
    echo $title;
    echo $subtitle;
    echo $button;
    echo '</div>';

    require 'footer.php'; ?>