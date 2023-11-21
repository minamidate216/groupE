<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php $pdo = new PDO($connect, USER, PASS); ?>

<form action="G1-5-1.php" method="post">
    商品検索
    <input type="text" name="keyword">
    <input type="submit" value="検索">

</form>
<hr>

<?php


if (isset($_GET['search'])) {
    // 特定のカテゴリIDに基づいて商品を取得して表示
    displayCategoryProducts($pdo, $_GET['search']);
} elseif (isset($_POST['keyword'])) {
    // キーワードに基づいて商品を検索して表示
    displayKeywordProducts($pdo, $_POST['keyword']);
} else {
    // 全てのカテゴリとそれに属する商品を表示
    $categories = $pdo->query('SELECT * FROM Category')->fetchAll();
    foreach ($categories as $category) {
        displayCategoryProducts($pdo, $category['category_id']);
    }
}

// 特定のカテゴリに属する商品を表示する関数
function displayCategoryProducts($pdo, $categoryId)
{
    $sql = $pdo->prepare('SELECT p.product_id, p.product_name,
           p.price,
           p.product_img,
           p.quantity,
         c.category  FROM Products as p INNER JOIN Category as c ON p.category_id = c.category_id
        where p.category_id = ?');
    $sql->execute([$categoryId]);
    $products = $sql->fetchAll();

    if (count($products) > 0) {
        echo '<h2>カテゴリ: ' . $products[0]['category'] . '</h2>';
        foreach ($products as $product) {
            displayProduct($product);
        }
    }
}

// キーワードに基づいて商品を検索する関数
function displayKeywordProducts($pdo, $keyword)
{
    $sql = $pdo->prepare('SELECT * FROM Products WHERE product_name LIKE ?');
    $keyword = '%' . $keyword . '%';
    $sql->execute([$keyword]);
    $products = $sql->fetchAll();

    foreach ($products as $product) {
        displayProduct($product);
    }
}

// 商品を表示する関数
function displayProduct($product)
{
    echo '<div>';
    echo '<a href="G1-8-1.php?id=', $product['product_id'], '">';
    echo '<form action="G1-8-1.php" method="post">';
    echo '<input type="hidden" name="id" value="', $product['product_id'], '">';
    echo '<img src="image/' . $product['product_img'] . '" style="height:100px;"><br>';
    echo '<p>' . $product['product_name'] . '</p>';
    echo $product['price'];
    if (!isset($product['quantity']) || $product['quantity'] <= 0) {
        echo '<p><strong>売り切れ</strong></p>';
    }
    echo '</form>';
    echo '</a>';
    echo '</div>';
}

?>
<?php require 'footer.php'; ?>