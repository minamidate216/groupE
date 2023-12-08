<?php
//セッション開始を確認
if (
    (function_exists('session_status')
        && session_status() !== PHP_SESSION_ACTIVE) || !session_id()
) {
    // セッション開始していなければスタート
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
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
    <?php require_once 'db-connect.php'; ?>
    <nav class="navbar" style="background-color:#336633;">
        <div class="navbar-brand mr-4">&nbsp;&nbsp;&nbsp;
            <a href="G1-1-1.php?" class="has-text-light is-size-3">
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
                        $headSql = new PDO($connect, USER, PASS);
                        $sql = $headSql->query('select * from Category');
                        foreach ($sql as $row) {
                            echo '<hr class="navbar-divider">';
                            echo '<a class="navbar-item" href="G1-5-1.php?search=', $row['category_id'], '">';
                            echo $row['category'];
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
                <div class="navbar-item mr-4 ">
                    <a>
                        <?php
                        if (!isset($_SESSION['Users'])) {
                            echo '<a href="G1-2-1.php" class="has-text-light">ログイン</a>';
                        } else {
                            echo '<a href="G1-2-7.php" class="has-text-light">ログアウト</a>';
                        }
                        ?>
                        <span class="icon is-size-4"><i class="fas fa-exchange-alt"></i></span>
                    </a>
                </div>


            </div>
        </div>
    </nav>