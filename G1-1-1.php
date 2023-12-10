<?php session_start(); ?>
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
<style>
    @font-face {
        font-family: 'MyFont';
        src: url(./ShinRetroMaruGothic/ShinRetroMaruGothic-M.ttf);
    }

    body {
        font-family: MyFont;
    }
</style>

<body>
    <?php require 'db-connect.php'; ?>
    <nav class="navbar" style="background-color:#336633;">
        <div class="navbar-brand mr-4">&nbsp;&nbsp;&nbsp;
            <a href="G1-1-1.php" class="has-text-light is-size-3">
                <span class="icon">
                    <i class="fas fa-home"></i>
                </span>&nbsp;
                miyosi farm
            </a>


        </div>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="menu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
        <div id="menu" class="navbar-menu">
            <div class="navbar-start">


            </div>

            <div class="navbar-end has-text-light">
                <div class="navbar-item has-dropdown is-hoverable mr-6 has-text-light">
                    <a class="navbar-link has-text-light" style=".navbar-link:hover{color:black;}">
                        PRODUCT　<span class="icon is-size-4"><i class="fas fa-search"></i></span>　
                    </a>

                    <div class="navbar-dropdown">
                        <form class="navbar-item" action="G1-5-1.php" method="post">
                            <input type="text" name="keyword" placeholder="商品のキーワード">
                            <button type="submit"><i class="fas fa-search"></i></button>
                            <a class="navbar-item">

                        </form>
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item" href="G1-5-1.php">ALL</a>
                        <?php
                        $pdo = new PDO($connect, USER, PASS);
                        $sql = $pdo->query('select * from Category');
                        foreach ($sql as $row) {
                            echo '<hr class="navbar-divider">';
                            echo '<a class="navbar-item" href="G1-5-1.php?search=', $row['category_id'], '">';
                            echo $row['category'], 'ヨーグルト';
                            echo '</a>';
                        } ?>
                    </div>
                </div>
                <div class="navbar-item mr-4 ">
                    <a href="G1-6-1-show.php" class="has-text-light"><span class="icon is-size-4">
                            <i class="far fa-heart"></i>
                        </span>
                    </a>
                </div>
                <div class="navbar-item mr-4 ">
                    <a href="G1-7-1.php" class="has-text-light">注文履歴&nbsp;&nbsp;<span class="icon is-size-4"><i
                                class="fas fa-history"></i></span></a>
                </div>
                <div class="navbar-item mr-4 ">
                    <a href="G1-9-1-show.php" class="has-text-light">カート<span class="icon is-size-4"><i
                                class="fas fa-shopping-cart"></i></span></a>
                </div>
                <div class="navbar-item mr-4 ">
                    <a href="G1-4-1.php" class="has-text-light">コラム&nbsp;&nbsp;<span class="icon is-size-4"><i
                                class="fas fa-book-open"></i></span></a>
                </div>
                <div class="navbar-item mr-4">
                    <a href="G1-3-3.php" class="has-text-light">マイページ&nbsp;<span class="icon is-size-4"><i
                                class="fas fa-portrait"></i></span></a>
                </div>
                <div class="navbar-item mr-4 ">
                    <a class="has-text-light">
                        <?php
                        //リファラ（リンク元の情報）を取得できればボタン押して戻るメソッドらしいですわ
                        $h = $_SERVER['HTTP_HOST'];
                        // リファラ値があれば、かつ外部サイトでなければaタグで戻るリンクを表示
                        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], $h) !== false)) {
                            echo '<a class="has-text-light" href="' . $_SERVER['HTTP_REFERER'] . '">戻る';
                        }

                        ?>&nbsp;
                        <span class="icon is-size-3 has-text-light"><i class="fas fa-door-open"></i></span>
                    </a>
                </div>
                <div class="navbar-item mr-4 has-text-light">
                    <?php
                    if (!isset($_SESSION['Users'])) {
                        echo '<a class="has-text-light" href="G1-2-1.php">ログイン&nbsp;&nbsp;';
                        echo '<span class="icon is-size-4"><i class="fas fa-sign-in-alt"></i></span></a>';
                    } else {
                        echo '<a class="has-text-light" href="G1-2-7.php">ログアウト&nbsp;&nbsp;';
                        echo '<span class="icon is-size-4"><i class="fas fa-sign-out-alt"></i></span></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </nav>
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
        <ul class="columns" style="display: flex; flex-wrap: wrap;">
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
                echo '<li class="column is-10-mobile is-2-tablet is-3-desktop is-3-widescreen is-4 p-6"><a class="image is-256x256" href="G1-5-1.php?search=', $row['category_id'], '">';
                echo '<img class="is-rounded pb-5" src="image/', $row['category_img'], '" alt="">';
                echo '<p class="subtitle has-text-centered has-text-primary-dark ">', $row['category'], '</p>';
                echo '<p class="subtitle has-text-centered has-text-primary-dark ">ヨーグルト</p>';
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
                echo '<li class="column is-10-mobile is-2-tablet is-3-desktop is-3-widescreen is-4 p-6"><a class="image is-256x256" href="G1-4-2.php?column_id=', $row['column_id'], '">';
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