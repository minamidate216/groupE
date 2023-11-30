<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>注文確認画面</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <style>
        .product-card {
            display: flex;
            align-items: center;
        }

        .product-image {
            width: 100px;
            /* 画像のサイズ調整 */
            margin-right: 15px;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-price {
            font-size: 1.5em;
            color: #3273dc;
            /* Bulmaのリンク色 */
        }

        .product-quantity {
            width: 3em;
            text-align: center;
        }

        .summary-box {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <form action="G1-5-1.php" method="post">
        <a href="G1-1-1.php"><img src="image/top.png" height="100px" width="100px">miyosi farm</a>
        <input type="text" name="keyword">
        <input type="submit" value="検索">
    </form>
    <a href="G1-6-1.php">お気に入り</a>
    <a href="G1-5-1.php">商品</a>
    <a href="G1-7-1.php">注文履歴</a>
    <a href="G1-9-1-show.php">カート</a>
    <a href="G1-4-2.php">コラム</a>
    <a href="G1-3-3.php">マイページ</a>
    <?php
    if (!isset($_SESSION['Users'])) {
        echo '<a href="G1-2-1.php">ログイン</a>';
    } else {
        echo '<a href="G1-2-7.php">ログアウト</a>';
    }
    ?>
    </div>
    <hr>
    <hr>
    <?php
    // 在庫の確認をします
    // 配送日の取得
    $deliveryDate = date('Y-m-d', strtotime('+2 days'));
    ?>


    <div id="vueApp">
        <section>
            <div class="container">
                商品画像：商品名：価格：小計
                <!-- 商品情報 -->
                <div class="product-card" v-for="product in allData" :key="product.id">
                    <img class="product-image" :src="'image/' + product.image" :alt="product.name"
                        style="width: 100px;">
                    <div class="productdetails">
                        <p class="title is-4">{{ product.name }}</p>
                        <p class="product-price">{{ product.price }}円</p>
                    </div>
                    <button class="button" @click="increment(product.id)">+1</button>
                    {{ product.count }}個
                    <button class="button" @click="decrement(product.id)">-1</button>
                    {{ product.price * product.count }}円
                </div>
            </div>

            <div class="field">
                <label class="label">配送日</label>
                <div class="control">
                    <h3>
                        <? echo $deliveryDate ?>
                    </h3>
                </div>
            </div>
            <div class="field">

                <?php if (isset($_SESSION['Users'])) {
                    echo '<div>';
                    echo '<p>名前：', $_SESSION['Users']['user_name'], '</p>';
                    echo '<p>住所：', $_SESSION['Users']['address'], '</p>';
                    echo '<p>連絡先：', $_SESSION['Users']['email'], '</p>';
                    echo '<div>';
                }
                ?>
            </div>
            <div class="total">
                <p>合計金額</p>
                <p>{{ Total }}</p>
            </div>
        </section>
        <td>{{ message }}</td>
        <form action="G1-10-2.php" method="post">
            <div v-for="product in allData" :key="product.id">
                <input type="hidden" :name="'productCount[' + product.id + ']'" :value="product.count">
                <input type="hidden" :name="'productId[' + product.id + ']'" :value="product.id">
                <input type="hidden" :name="'productName[' + product.id + ']'" :value="product.name">
                <input type="hidden" :name="'productPrice[' + product.id + ']'" :value="product.price">
                <input type="hidden" :name="'productImage[' + product.id + ']'" :value="product.image">
            </div>
            <input type="submit" value="購入">
        </form>
    </div>
    <!-- Vue.jsを適用するセクション -->
    <script>var productFromPHP = <?php echo json_encode($_SESSION['product']); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="./script/ajax.js"></script>
</body>

</html>