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
    $isFavorite = true;

} else {
    $isFavorite = false;
}






// 商品情報の取得
$productId = $_GET['id'];
$productSql = $pdo->prepare('select * from Products where product_id=?');
$productSql->execute([$productId]);
foreach ($productSql as $row) {
    echo '<form action="G1-9-1-insert.php" method="post">';
    echo '<div class="columns " style="display:flex; flex-wrap:wrap";>';
    echo '<div class="column is-4" >';
    echo '<img alt="image" src="image/', $row['product_img'], '" style="width:400px;
                                                                        margin-left:40px;
                                                                        border-radius: 8px";>';
    echo '</div>';
    echo '<div class="column is-4">';
    echo '<img alt="image" src="image/', $row['product_sub_img'], '" style="width:400px;
                                                                            border-radius: 8px";></div>';
    echo '<div class="column is-4">';
    echo '<div class="box" style="border-width: 3px;
                                    border-style: solid;
                                    border-color: #f0fff0;
                                    height: 200px;
                                    margin-right:30px";>';
    echo '<h3 class="title has-text-primary-dark">', $row['product_name'], '</h3>';
    echo '<p class="subtitle has-text-right has-text-primary-dark" >', $row['price'], '円</p><br>';
    echo '<p class="subtitle has-text-right has-text-primary-dark" >', $row['capacity'], '</p></div>';
    echo '<div class="select is-medium is-rounded"><select name="count">';
    for ($i = 1; $i <= $row['quantity']; $i++) {
        echo '<option value="', $i, '" >', $i, '個</option>';
    }
    echo '</select></div><br>';
    echo '<input type="submit" value="カートに追加" style="margin: 30px";></div>';
    echo '<div class="columns is-mobile">';
    echo '<section class="column is-10-mobile is-10-tablet is-12-desktop is-10-widescreen is-6-fullhd" style="margin:30px;  width:1200px";><h3 class="title">', $row['description'], '</h3></section>';
    echo '<input type="hidden" name="id" value="', $row['product_id'], '">';
    echo '<input type="hidden" name="name" value="', $row['product_name'], '">';
    echo '<input type="hidden" name="price" value="', $row['price'], '">';
    echo '<input type="hidden" name="description" value="', $row['description'], '">';
    echo '<input type="hidden" name="image" value="', $row['product_img'], '">';
    echo '<input type="hidden" name="quantity" value="', $row['quantity'], '">';
    echo '</form>';
}


?>
<div id="vueApp" class="column">
    <!-- お気に入りボタン -->
    <i :class="{'fas fa-heart': isFavorite, 'far fa-heart ': !isFavorite}" @click="toggleFavorite"
        style=font-size:150px;color:#a3ffa3;></i>
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

<?php require 'footer.php'; ?>