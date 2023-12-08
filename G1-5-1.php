<?php require 'header.php'; ?>

<?php $pdo = new PDO($connect, USER, PASS); ?>


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
        echo '<h2 class="title has-text-centered has-text-primary-dark">' . $products[0]['category'] . 'ヨーグルト</h2>';
        echo '<ul style="display: flex; flex-wrap: wrap;">';
        foreach ($products as $product) {
            displayProduct($product);
        }
        echo '</ul>';
    }
}

// キーワードに基づいて商品を検索する関数
function displayKeywordProducts($pdo, $keyword)
{
    $sql = $pdo->prepare('SELECT * FROM Products WHERE product_name LIKE ?');
    $keyword = '%' . $keyword . '%';
    $sql->execute([$keyword]);
    $products = $sql->fetchAll();
    echo '<ul style="display: flex; flex-wrap: wrap;">';
    foreach ($products as $product) {
        displayProduct($product);
    }
    echo '</ul>';
}

// 商品を表示する関数
function displayProduct($product)
{
    echo '<li class="card m-6 " style="border-radius: 40px";>';
    echo '<a href="G1-8-1.php?id=', $product['product_id'], '">';
    echo '<div class="card-image">';
    echo '<figure class="image">';
    echo '<img src="image/' . $product['product_img'] . '" style="width: 250px; border-radius: 40px 40px 0px 0px"; ><br>';
    echo '</figure>';
    echo '<div class="card-content ">';
    echo '<div class="content"><h6 class="has-text-right has-text-primary-dark">' . $product['product_name'] . '</h6><br>';
    echo '<p class="has-text-right has-text-success-dark">' . $product['price'] . '円</p></div></div>';
    if (!isset($product['quantity']) || $product['quantity'] <= 0) {
        echo '<p><strong class="subtitle has-text-danger">売り切れ</strong></p>';
    }
    echo '</a>';
    echo '</li>';
}

?>
<?php require 'footer.php'; ?>