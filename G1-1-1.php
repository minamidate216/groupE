<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="css/top.css">
<title>Document</title>
</head>
<body>
<div class="">
<a href="G1-1-1.php"><img src="image/top.png" height="50px" width="50px">miyosi farm</a>
<form action="G1-5-1.php" method="post">
<input type="text" name="keyword">
<button type="submit">検索</button>
</form>
<a href="G1-6-1.php">お気に入り</a>
<a href="G1-7-1.php">注文履歴</a>
<a href="G1-9-1.php">カート</a>
<a href="G1-4-2.php">コラム</a>
<?php
if(!isset($_SESSION['Users'])){
    echo '<a href="G1-2-1.php">ログイン</a>';
}else{
    echo '<a href="G1-2-7.php">ログアウト</a>';
}
?>
</div>
<hr>

    <div class="image-container">
        <img src="image/top.png" alt="Description">
    </div>
    <div class="product">
        <h4 class="title">PRODUCTS</h4>
    </div>
    <div class="column">
        <ul>
            <div class="product_card">
                <li><a href="G1-5-1.php?">
                        <img class="img_link" src="image/0.png" alt="">
                        <p>商品一覧</p>
                    </a></li>
                <?php
                $pdo = new PDO($connect, USER, PASS);
                $sql = $pdo->query('select * from Category');

                foreach ($sql as $row) {
                    echo '<li><a href="G1-5-1.php?search=', $row['category_id'], '">';
                    echo '<img class="img_link" src="image/', $row['category_img'], '" alt="">';
                    echo '<p>', $row['category'], '</p>';
                    echo '</a></li>';
                }

                ?>
            </div>
        </ul>
    </div>
    </div>
    <div class="column">
        <h4>COLUMN</h4>
        <ul>

            <?php
            $sql = $pdo->query('select * from Columns');
            foreach ($sql as $row) {
                echo '<li><a href="G1-4-1.php?column=', $row['column_id'], '">';
                echo '<img class="img_link" src="image/', $row['post_img'], '" style="height:100px;"><br>';
                echo '<p>', $row['column_title'], '</p>';
                echo '</a></li>';
            }
            ?>

        </ul>
    </div>


</body>

</html>