<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<hr>
<?php
$pdo = new PDO($connect, USER, PASS);
// お気に入りに登録されているかどうかの確認
$favoriteSql = $pdo->prepare('select count(*) from Favorites where user_id=? and product_id = ?');
$favoriteSql->execute([$_SESSION['Users']['user_id'], $_GET['id']]);
$count = $favoriteSql->fetchColumn();
if ($count > 0) {
    $isFavorited = true;

} else {
    $isFavorited = false;
}






// 商品情報の取得
$productId = $_GET['id'];
$productSql = $pdo->prepare('select * from Products where product_id=?');
$productSql->execute([$productId]);
foreach ($productSql as $row) {
    echo '<form action="G1-9-1-insert.php" method="post">';
    echo '<div class="columns">';
    echo '<div class="column is">';
    echo '<div class="card ml-6 mb-6" style="width: 300px";><div class="card-image"><figure class="image"><img alt="image" src="image/', $row['product_img'], '" style="width:300px";></figure></div></div>';
    echo '</div>';
    echo '<div class="column">';
    echo '<div class="card mb-6 " style="width: 300px";><div class="card-image"><figure class="image"><img alt="image" src="image/', $row['product_sub_img'], '" style="width:300px";></figure></div></div>';
    
    echo '<p>商品名:', $row['product_name'], '</p>';
    echo '<p>価格:', $row['price'], '</p>';
    echo '<p>内容量:', $row['capacity'], '</p>';
    echo '<p><select name="count">';
    for ($i = 1; $i <= $row['quantity']; $i++) {
        echo '<option value="', $i, '">', $i, '</option>';
    }
    echo '</select>  個</p>';
    echo '</div>';
    echo '</div>';
    echo '<input type="hidden" name="id" value="', $row['product_id'], '">';
    echo '<input type="hidden" name="name" value="', $row['product_name'], '">';
    echo '<input type="hidden" name="price" value="', $row['price'], '">';
    echo '<input type="hidden" name="description" value="', $row['description'], '">';
    echo '<input type="hidden" name="image" value="', $row['product_img'], '">';
    echo '<input type="hidden" name="quantity" value="', $row['quantity'], '">';
    echo '<h5 class="subtitle ml-6">', $row['description'], '</h5>';
    echo '<p><input class="ml-6" type="submit" value="カートに追加"></p>';
    echo '</form>';
}


?>
<div id="vueApp">
    <!-- お気に入りボタン -->
    <i :class="{'fas fa-heart': isFavorited, 'far fa-heart': !isFavorited}" @click="toggleFavorite"></i>
</div>



<!-- script.jsに商品とお気に入りの情報を渡す⇩ -->
<script>
    var productFromPHP = <?php echo json_encode($productId); ?>;
    var favoriteFromPHP = <?php echo json_encode($isFavorited); ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="./script/script.js"></script>

<?php require 'footer.php'; ?>