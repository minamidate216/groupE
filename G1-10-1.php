<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<hr>
<?php
$pdo = new PDO($connect, USER, PASS);
$productIds = array_keys($_SESSION['product']);
$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$sql = "SELECT * FROM Products WHERE product_id IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($productIds);
$products = $stmt->fetchAll();
// 在庫の確認をします

if (!isset($_SESSION['Users'])) {
    // ユーザーがログインしていない場合は、ログインを促す
    echo '<a href="G1-2-1.php">ログイン</a>';
} else {
foreach ($_SESSION['product'] as $id => $cartItem) {
    foreach ($products as $product) {
        if ($product['product_id'] == $id) {
            if ($product['quantity'] < $cartItem['count']) {
                echo "商品ID {$id} の在庫が足りません。<br>";
            } else {
                echo "商品ID {$id} の在庫が足りています。<br>";
            }
            break; // 適切な商品が見つかったらループを終了
        }
    }
}


<<<<<<< HEAD
if (!isset($_SESSION['Users'])) {
    // ユーザーがログインしていない場合は、ログインを促す
    echo 'ログインしろや';
}
// jsに個数のデータを送る

$deliveryDate = date('Y-m-d', strtotime('+2 days'));
echo "<h4>配送日</h4>";
echo "<div>", $deliveryDate, "</div>";
// Vueの条件付きレンダリングを使います多分
echo '<div id="app">';
echo "<h4>商品情報</h4>";
// カート情報の確認
if (!empty($_SESSION['product'])) {
    echo '<table>';
    echo '<tr><th>商品画像</th><th>商品名</th>';
    echo '<th>個数</th><th>価格</th><th>小計</th><th></th></tr>';
    $total = 0;
    foreach ($_SESSION['product'] as $id => $product) {
        $quan = $_SESSION['product'][$id]['count'];
        $price = $_SESSION['product'][$id]['price'];
        echo '<tr>';
        echo '<td><img src="image/', $product['image'], '" style="width: 100px;"></td>';
        echo '<td><a href="G1-8-1.php?id=', $id, '">',
            $product['name'], '</a></td>';
            // 個数を計算かつ個数を変更できる
            
            echo '<td>';
            echo '
                    <p>
                    <button class="button is-outlined is-small"
                        @click="increment"
                        >+1</button>
                        {{ count }}
                    <button class="button is-outlined is-small"
                        @click="decrement"
                        >-1</button></p>';
            echo '</td>';
            echo '<td>', $product['price'], '</td>';
        echo '<td><p>{{ isPrice }}</p></td>';
=======
    
    echo '<form action="G1-10-2.php">';
    $deliveryDate = date('Y-m-d', strtotime('+2 days'));
    echo "<h4>配送日</h4>";
    echo "<div>", $deliveryDate, "</div>";
    // Vueの条件付きレンダリングを使います多分
    echo '<div id="app">';
    echo "<h4>商品情報</h4>";
    // カート情報の確認
    if (!empty($_SESSION['product'])) {
        echo '<table>';
        echo '<tr><th>商品画像</th><th>商品名</th>';
        echo '<th>個数</th><th>価格</th><th>小計</th><th></th></tr>';
        $total = 0;
        foreach ($_SESSION['product'] as $id => $product) {
            echo '<tr>';
        echo '<td><img src="image/', $product['image'], '" style="width: 100px;"></td>';
        echo '<td><a href="G1-8-1.php?id=', $id, '">',
        $product['name'], '</a></td>';
        // 個数を計算かつ個数を変更できる
        echo '<div id="app">';
        echo '<p>{{ count }}';
        echo '<button class="button is-warning is-outlined is-small"
        @click="increment"
        >+1</button>';
        echo '<button class="button is-link is-outkined is-small"
        @click="decrement"
        >-1</button></p>';
        echo '</div>';
        echo '<td><select name="count">'; 
        for($i = 1; $i <= $product['quantity'];$i++){
            echo '<option value="',$i, '">', $i,'</option>';
        } 
        echo '</td>';
        echo '<td>', $product['price'], '</td>';
        $subtotal = $product['price'] * $product['count'];
        $total += $subtotal;
        echo '<td>', $subtotal, '</td>';
>>>>>>> 08e35953cbf66c2eedabd59b4d334c3b788aae0a
        echo '<td><a href="cart-delete.php?id=', $id, '">削除</a></td>';
        echo '</tr>';
    }
    echo '<tr><td>合計</td><td></td><td></td><td></td><td>', $total,
    '</td><td></td></tr>';
    echo '</table>';
    echo '</div>';
} else {
    echo 'カートに商品がありません。';
}

echo '<h4>配送先</h4>';
if (isset($_SESSION['Users'])) {
    echo '<div>';
    echo '<p>名前：', $_SESSION['Users']['user_name'], '</p>';
    echo '<p>住所：', $_SESSION['Users']['address'], '</p>';
    echo '<p>連絡先：', $_SESSION['Users']['email'], '</p>';
    echo '</div>';
}
}
?>
    <input type="submit" value="購入">
</form>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
let ccc = <?php echo $quan; ?>;
let pro_price = <?php echo $price; ?>;
console.log(pro_price);
new Vue({
    el: '#app',
    data(){
        return{
            count: ccc,
            price: pro_price,
            sum: 0
        };
    },
    methods: {
        increment() {
            this.count++;
        },
        decrement() {
            this.count--;
        }
    },
    computed: {
        isPrice() {
            return this.price * this.count;
        }
    }
});
</script>
<?php require 'footer.php'; ?>