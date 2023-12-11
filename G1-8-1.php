<?php require 'header.php'; ?>

<br>
<br>
<br>
<?php
if (empty($_SESSION['Users'])) {
    echo 'ログインしてください。<br>';
    echo '<a href="G1-2-1.php">ログインへ';
} else {
    $description = "";
    $productId = $_GET['id'];
    $isFavorite = false;
    $pdo = new PDO($connect, USER, PASS);
    // お気に入りに登録されているかどうかの確認
    $favoriteSql = $pdo->prepare('select count(*) from Favorites where user_id=? and product_id = ?');
    $favoriteSql->execute([$_SESSION['Users']['user_id'], $_GET['id']]);
    $count = $favoriteSql->fetchColumn();
    // if(empty($_SESSION['product'])){
    //     $cartStock = 0;
    // } elseif(!empty($_SESSION['product'])){
    //     foreach($_SESSION['product'] as $id => $product){
    //         if()
    //     }
    // }
    $purchaseStock = 0;
    $cartStock = 0;
    $message = '<a href="G1-5-1.php" class="subtitle has-text-danger">売り切れ   商品一覧へ<i class="fas fa-reply"></i></a>';
    if ($count > 0) {
        $isFavorite = true;
    }
    // カートのセッション情報に表示されている商品と同じものがあれば在庫を取得する。
    if (isset($_SESSION['product'][$productId])) {
        /*
        foreach ($_SESSION['product'] as $id => $row) {
            if ($id == $productId) {
                $cartStock = $row['count'];
            }
        }
        */
        $cartStock = $_SESSION['product'][$productId]['count'];
    }


    // 商品情報の取得
    $productSql = $pdo->prepare('select * from Products where product_id=?');
    $productSql->execute([$productId]);
    echo '<div class="content">';
    echo '<div class="container is-fluid">';
    foreach ($productSql as $row) {
        $purchaseStock = $row['quantity'];
        $description = $row['description'];
        $maxPurchaseStock = $purchaseStock;
        if ($cartStock > 0) {
            $maxPurchaseStock = $purchaseStock - $cartStock;
        if ($maxPurchaseStock > 0 && $maxPurchaseStock < 10) {
            $message = '在庫残り' . $maxPurchaseStock . '個となります。';
            echo $message;
        } elseif ($maxPurchaseStock >= 10) {
            $maxPurchaseStock = 10;
        } elseif ($maxPurchaseStock <= 0) {
            $maxPurchaseStock = 0;
            $message = '<a href="G1-9-1-show.php" class="subtitle has-text-danger">カート内の個数が最終在庫となります。    <span class="icon is-size-4"><i
                class="fas fa-shopping-cart"></i></span></a>';
            }
        }
        echo '<form action="G1-9-1-insert.php" method="post">';
        echo '<article class="media">';
        echo '<div class="media-left">';
        //  左側の写真と説明
        echo '<img alt="image" src="image/', $row['product_img'], '" style="width:400px; margin-left: 15px;
                                                                         border-radius: 10px";>';
        // echo '<h3 class="sub-title" style="width:390px; margin-right:10px";>', $row['description'], '</h3>';
        echo '</div>';
        echo '<div class="media-content">';
        // 中央の写真
        echo '<img alt="image" src="image/', $row['product_sub_img'], '" 
        style="width:400px; border-radius: 8px";></div>';
        echo '<div class="media-right" style="width:30%; margin-right:20px";>';
        // 右側の商品情報とカートボタンとハートボタン
        echo '<div class="box">';
        echo '<h3 class="title has-text-primary-dark">', $row['product_name'], '</h3>';
        echo '<p class="subtitle has-text-right has-text-primary-dark" >', $row['price'], '円</p><br>';
        echo '<p class="subtitle has-text-right has-text-primary-dark" >', $row['capacity'], '</p>';
        if ($maxPurchaseStock < 10 && $maxPurchaseStock > 0) {
            // 在庫が10より少ない時
            echo '<p class="subtitle has-text-danger">商品の残り在庫は、', $maxPurchaseStock, '個です。</p>';
            echo '<div class="select is-medium is-rounded"><select name="count">';
            for ($i = 1; $i <= $maxPurchaseStock; $i++) {
                echo '<option value="', $i, '" >', $i, '個</option>';
            }
            echo '</select></div></div><br>';
            echo '<input class="button is-success is-light" type="submit" value="カートに追加" style="display: block; margin-left: auto";><br><br>';
            echo '<a class="button is-primary is-dark" href="G1-8-2.php?id=', $productId, '" style="width:30%; display: block; margin-left: auto";>定期購入</a>';
        } elseif ($maxPurchaseStock >= 10) {
            // 在庫がカートの中の商品数を引いても10以上の時
            echo '<div class="select is-medium is-rounded"><select name="count">';
            for ($i = 1; $i <= 10; $i++) {
                echo '<option value="', $i, '" >', $i, '個</option>';
            }
            echo '</select></div></div><br>';
            echo '<input class="button is-success is-light" type="submit" value="カートに追加" style="display: block; margin-left: auto";><br><br>';
            echo '<a class="button is-primary is-dark" href="G1-8-2.php?id=', $productId, '" style="width:30%; display: block; margin-left: auto";>定期購入</a>';
        } elseif ($maxPurchaseStock <= 0) {
            // 在庫がない,もしくはカートの中に入れている個数で在庫終了の時は、カートに追加ボタンは消しておいて商品一覧とカートへのリンクを表示
            echo '<div>', $message, '</div></div><br>';
        }
        // for ($i = 1; $i <= $row['quantity']; $i++) {
        //     echo '<option value="', $i, '" >', $i, '個</option>';
        // }
        // echo '</select></div></div><br>';
        // echo '<input class="button is-info is-light" type="submit" value="カートに追加" style="margin: 30px";>';
        echo '<input type="hidden" name="id" value="', $row['product_id'], '">';
        echo '<input type="hidden" name="name" value="', $row['product_name'], '">';
        echo '<input type="hidden" name="price" value="', $row['price'], '">';
        echo '<input type="hidden" name="description" value="', $row['description'], '">';
        echo '<input type="hidden" name="image" value="', $row['product_img'], '">';
        echo '<input type="hidden" name="quantity" value="', $row['quantity'], '">';
        echo '</form>';
    }

    ?>
    <div id="vueApp">
        <!-- お気に入りボタン -->
        <i :class="{'fas fa-heart': isFavorite, 'far fa-heart': !isFavorite}" @click="toggleFavorite"
            style=font-size:80px;color:#00533f;text-align:right;></i>
    </div>
    </article>
    <?php echo '<h3 class="sub-title" style="width:820px; margin-right:10px";>', $description, '</h3>'; ?>
    </div>
    </div>




    <!-- script.jsに商品とお気に入りの情報を渡す⇩ -->
    <script>
            var productFromPHP = <?php echo json_encode($productId); ?>;
            var favoriteFromPHP = <?php echo json_encode($isFavorite); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="./script/script.js"></script>


    <?php require 'footer.php';
} ?>