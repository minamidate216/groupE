<?php require 'header.php';?>
    <hr>


    <br>
    <br>
    <hr>

    <div class="content container">

        <h1>購入確認</h1>
        <div id="vueApp">
            <section>
                <div class="card">
                    <table class="table is-fullwidth is-striped ">
                        <div class="card-header">
                            <thead>
                                <tr class="has-background-success-light">
                                    <th class="m*-3">商品画像</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>個数</th>
                                    <th>小計</th>
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                            <tr v-for="product in allData" :key="product.id">
                                <th><img class="product-image" :src="'image/' + product.image" :alt="product.name"
                                        style="width: 200px;"></th>
                                <th class="subtitle">{{ product.name }}</th>
                                <th class="product-price">{{ product.price }}円</th>
                                <th>
                                    <div class="field has-addons"><button class="button"
                                            @click="increment(product.id)">+1</button>
                                        <button class="button" style="pointer-events: none;">{{ product.count
                                            }}個</button>
                                        <button class="button" @click="decrement(product.id)">-1</button>
                                    </div>
                                    <div class="help has-text-success-dark" v-if="product.count == 0">{{ product.name }}の<br>注文をキャンセルします</div>
                                    <div class="help has-text-success-dark" v-else-if="product.quantity == product.count">これ以上は<br>在庫がありません</div>
                                    <div class="help has-text-success-dark" v-else-if="product.count == 10">注文は一度に<br>10個までとなります</div>
                                </th>
                                <th>{{ product.price * product.count }}円
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <br>
                <br>
                <hr>
                <div class="card">
                    <header class="card-header has-background-success-light">
                        <span class="icon">
                            <i class="fas fa-shipping-fast" aria-hidden="true"></i>
                        </span>
                        <p class="card-header-title">
                            配送日
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <h3>
                                <?php
                                $deliveryDate = date('Y-m-d', strtotime('+2 days'));
                                echo $deliveryDate ?>
                            </h3>
                            <br><br>
                        </div>
                    </div>
                </div>
                <!-- 購入者情報 -->
                <br>
                <br>
                <hr>
                <div class="card">
                    <header class="card-header has-background-success-light">
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
        </div>
    </div>
    <!-- Vue.jsを適用するセクション -->
    <script>var productFromPHP = <?php echo json_encode($_SESSION['product']); ?>;
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="./script/ajax.js"></script>
</body>

</html>