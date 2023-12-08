<?php
require 'db-connect.php';
require 'header.php';

try {
    $connect = new PDO($connect, USER, PASS);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

try {
    // 商品情報とカテゴリ名を結合して取得
    $query = "SELECT Products.*, Category.category FROM Products
              INNER JOIN Category ON Products.category_id = Category.category_id";
    $stmt = $connect->query($query);
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}
?>
<form action="G2-2-2.php" method="post">
    <?php
    echo '<div class="content">';
    echo '<div class="container has-text-centered">'; // has-text-centeredクラスを追加
    ?>
    <table class="table is-bordered is-fullwidth">
        <h1 class="title is-3 has-text-centered">商品管理</h1>
        <thead>
        <tr class="has-background-success-dark">
            <th class="has-text-light">商品名</th>
            <th class="has-text-light">商品画像</th>
            <th class="has-text-light">価格</th>
            <th class="has-text-light">カテゴリ</th>
            <th class="has-text-light">在庫数</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($product as $productData): ?>
            <tr>
                <td><?php echo htmlspecialchars($productData['product_name']); ?></td>
                <td><?php echo htmlspecialchars($productData['product_img']); ?></td>
                <td><?php echo htmlspecialchars($productData['price']); ?></td>
                <td><?php echo htmlspecialchars($productData['category']); ?></td>
                <td><?php echo htmlspecialchars($productData['quantity']); ?></td>
                <td class="has-text-light">
                    <button class="button is-info" type="button"
                            onclick="location.href='G2-2-5.php?product_id=<?php echo $productData['product_id']; ?>'">
                        更新
                    </button>
                </td>
                <td>
                    <button class="button is-danger" type="button"
                            onclick="location.href='G2-2-8.php?product_id=<?php echo $productData['product_id']; ?>'">
                        削除
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <button class="button is-primary">新規登録</button>
    </div>
    </div>
        </form>
</body>
</html>
