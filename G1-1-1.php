<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <!-- <link rel="stylesheet" href="css/top.css"> -->
    <title>Document</title>
</head>

<body>
    <div class="">
        <a href="G1-1-1.php"><img src="image/top.png" height="50px" width="50px">miyosi farm</a>
        <form action="G1-5-1.php" method="post">
            <input type="text" name="keyword">
            <button type="submit">検索</button>
        </form>
        <a href="G1-6-1-show.php">お気に入り</a>
        <a href="G1-7-1.php">注文履歴</a>
        <a href="G1-9-1-show.php">カート</a>
        <a href="G1-4-1.php">コラム</a>
        <?php
        if (!isset($_SESSION['Users'])) {
            echo '<a href="G1-2-1.php">ログイン</a>';
        } else {
            echo '<a href="G1-2-7.php">ログアウト</a>';
        }
        ?>
    </div>
    <hr>
    <ul class="slider">
        <li><img src="slide_img/0.png" alt="" style="width: 70vw;"></li>
        <li><img src="slide_img/1.png" alt=""></li>
        <li><img src="slide_img/2.png" alt=""></li>
        <li><img src="slide_img/3.png" alt=""></li>
        <li><img src="slide_img/4.png" alt=""></li>
        <li><img src="slide_img/5.png" alt=""></li>
        <li><img src="slide_img/6.png" alt=""></li>
        <li><img src="slide_img/7.png" alt=""></li>
        <li><img src="slide_img/8.png" alt=""></li>
        <li><img src="slide_img/9.png" alt=""></li>
        <!--/slider-->
    </ul>
    <div class="section">
        <h3 class="title has-text-centered has-text-primary-dark pb-5">PRODUCTS</h3>
        <ul class="columns" style="display: flex; flex-wrap: wrap";>
            <li class="column p-6">
                <a class="image is-256x256" href="G1-5-1.php?">
                    <img class="is-rounded pb-5" src="image/0.png" alt="">
                    <p class="subtitle has-text-centered has-text-primary-dark">商品一覧</p>
                </a>
            </li>
            <?php
            $pdo = new PDO($connect, USER, PASS);
            $sql = $pdo->query('select * from Category');
            foreach ($sql as $row) {
                echo '<li class="column p-6"><a class="image is-256x256" href="G1-5-1.php?search=', $row['category_id'], '">';
                echo '<img class="is-rounded pb-5" src="image/', $row['category_img'], '">';
                echo '<p class="subtitle has-text-centered has-text-primary-dark">', $row['category'], '</p>';
                echo '</a></li>';
            }

            ?>
        </ul>
    </div>
    <div class="section" style="background-color: #e0ffff;">
        <h3 class="title has-text-centered has-text-primary-dark">COLUMN</h3>
        <ul class="columns" style="display: flex; flex-wrap: wrap;">
            <?php
            $sql = $pdo->query('select * from Columns');
            foreach ($sql as $row) {
                echo '<li class="column is-10-mobile is-2-tablet is-3-desktop is-3-widescreen is-4 p-6"><a class="image is-256x256" href="G1-4-2.php?column=', $row['column_id'], '">';
                echo '<img class="p-5" src="image/', $row['post_img'], '" style="border-radius: 30px";><br>';
                echo '<p class="subtitle has-text-centered has-text-primary-dark">', $row['column_title'], '</p>';
                echo '</a></li>';
            }
            ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="script/slider.js"></script>
</body>

</html>