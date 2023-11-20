<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>サイトトップ画面</title>
</head>

<body>

    <?php require 'header.php'; ?>

    <img class="top_img" src="image/0.png" alt="">
    <div class="product">
        <h4 class="title">PRODUCTS</h4>
    </div>
    <div class="column">
        <ul>
            <div class="product_card">
                <li><a href="G1-5-1.php?"  >
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
                echo '<li><a href="column.php?column=', $row['column_id'], '">';
                echo '<img class="img_link" src="image/', $row['post_img'], '" style="height:100px;"><br>';
                echo '<p>', $row['column_title'], '</p>';
                echo '</a></li>';
            }
            ?>

        </ul>
    </div>


</body>

</html>