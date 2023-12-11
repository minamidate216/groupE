<?php require 'header.php'; ?>

<br>
<br>
<br>


<?php
$pdo = new PDO($connect, USER, PASS);
$productId =$_GET['id'];
// 日付の変数
$currentDateTime = date('Y-m-d H:i:s');
$minDateTime = date('Y-m-d', strtotime('+2 days'));
$maxDateTime = date('Y-m-d', strtotime('+30 days'));
// 画面に表示させるもの
$product_name = "";
$product_img = "";


// 商品テーブルから一致するものを取得する
$ProductSql = $pdo->prepare('SELECT * FROM Products
                                WHERE product_id = ?');
$ProductSql->execute([$productId]);

// 商品情報表示のための変数に格納
foreach($ProductSql as $row){
    $product_name = $row['product_name'];
    $product_img = $row['product_img'];
    // $product_ = $row[''];

}
echo '<div class="content">';
echo '<div class="has-text-centered">';
echo '        <h1>定期購入申込</h1>';
echo '        <form action="G1-8-3.php" method="POST" class="box" style="margin: 0 auto; width: 30%";>';
echo '            <div class="card">';
echo '                <header class="card-header has-text-centered">';
echo '                    <span class="card-header-icon"><i class="fas fa-cube"></i>';
echo '                        </span>';
echo '                    <p class="card-header-title ">';
echo                            $product_name;
echo '                    </p>';
echo '                </header>';
echo '                <div class="card-image">';
echo '                    <figure class="image is-128x128" style="margin: 0 auto";>';
echo '                        <img src="image/',$product_img, '" alt="イメージ">';
echo '                    </figure>';
echo '                </div>';
echo '                <div class="card-content">';
echo '                    <div class="content">';
echo '                        <div class="field">';
echo '                            <label class="label"><strong>定期購入間隔</strong></label>';
echo '                            <div class="control">';
echo '                                <input type="text" name="interval" list="dateList">';
echo '                                <datalist id="dateList">';
echo '                                    <option value=10></option>';
echo '                                    <option value=20></option>';
echo '                                    <option value=30></option>';
echo '                                </datalist>';
echo '                            </div>';
echo '                            <p class="help is-success">10日間隔でお選びいただけます</p>';
echo '                        </div>';
echo '                        <div class="field">';
echo '                            <label class="label"><strong>定期購入開始日</strong></label>';
echo '                            <div class="control" style="style="margin: 0 auto";>';
echo '                                <input type="date" style="width:120px"; name="next_order_date" min=',$minDateTime,' max=',$maxDateTime,'>';
echo '                            </div>';
echo '                            <p class="help is-success">2日後からお選びいただけます</p>';
echo '                        </div>';
echo '                        <br><br>';
echo '                        <div class="field">';
echo '                            <label class="label"><strong>定期購入個数</strong></label>';
echo '                            <div class="control">';
echo '                                <input type="number" name="order_count" min=5 max=10>';
echo '                            </div>';
echo '                            <p class="help is-success">5〜10個まで選択できます</p>';
echo '                        </div>';
echo '                        <br><br>';
echo '                            <p class="help has-text-warning-dark">申し込みをキャンセルされる方は<br>
                                                            下記の商品一覧のリンクをクリックして下さい</p>';
echo                            ' <a class="help has-text-success-dark" href="G1-5-1.php">商品一覧へ<span class="icon">';
echo                            '<i class="fas fa-reply"></i></span></a>';
echo '                    </div>';
echo '                </div>';
echo '                <footer class="card-footer">';
echo '                    <button class="card-footer-item">申込確認へ<span class="icon is-small"><i';
echo '                                class="fas fa-shopping-cart"></i></span></button>';
echo '                </footer>';
echo '            </div>';
echo                '<input type="hidden" name="id" value="',$productId,'">';
echo                '<input type="hidden" name="name" value="',$product_name,'">';
echo                '<input type="hidden" name="img" value="',$product_img,'">';
echo '        </form>';
echo '    </div>';
echo '</div>';
?>

<?php require 'footer.php' ?>