<?php require 'header.php';?>
    <hr>


    <br>
    <br>
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
                <!-- 購入者情報 -->
                <br>
                <br>
                <hr>
                <div class="card">
                    <header class="card-header">
                        <span class="icon">
                            <i class="far fa-id-card" aria-hidden="true"></i>
                        </span>
                        <p class="card-header-title">
                            購入者情報
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <strong>
                                <?php if (isset($_SESSION['Users'])) {
                                    echo '<div>';
                                    echo '<h3>名前：', $_SESSION['Users']['user_name'], '</h3>';
                                    echo '<h3>住所：', $_SESSION['Users']['address'], '</h3>';
                                    echo '<h3>連絡先：', $_SESSION['Users']['email'], '</h3>';
                                    echo '<div>';
                                }
                                ?>
                            </strong>
                        </div>
                    </div>
                </div>

                <br><br>
            </section>
            <div class="has-text-right">
                <br>
                <br>
                <h1>合計金額</h1>
                <h3>{{ Total }}円</h3>
                <form action="G1-10-2.php" method="post">
                    <div v-for="product in allData" :key="product.id">
                        <input type="hidden" :name="'productCount[' + product.id + ']'" :value="product.count">
                        <input type="hidden" :name="'productId[' + product.id + ']'" :value="product.id">
                        <input type="hidden" :name="'productName[' + product.id + ']'" :value="product.name">
                        <input type="hidden" :name="'productPrice[' + product.id + ']'" :value="product.price">
                        <input type="hidden" :name="'productImage[' + product.id + ']'" :value="product.image">
                    </div>
                    <input class="button is-dark" type="submit" value="購入">
                </form>
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