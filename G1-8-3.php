<?php require 'header.php'; ?>
<!-- 定期購入確認画面　-->
<!-- 定期購入確認画面での入力を表示
ユーザーが確認をして送信を押すとデータベースに挿入する
遷移先はG1-8-3.php -->
<br>
<br>
<br>


<?php
$pdo = new PDO($connect, USER, PASS);

$user_id = $_SESSION['Users']['user_id'];
$product_id = $_POST['id'];
$product_name = $_POST['name'];
$product_img = $_POST['img'];
$post_interval = $_POST['interval'];
$post_next_order_date = $_POST['next_order_date'];
$post_order_count = $_POST['order_count'];


echo '<p>画面表示</p>';
echo '<p>ID: ' . $product_id . '</p>';
echo '<p>名前: ' . $product_name . '</p>';
echo '<p>画像: <img src="image/' . $product_img . '" alt="画像" style="width: 100px";></p>';


echo '<p>データベース用</p>';
echo '<p>ユーザーID: ' . $user_id . '</p>';
echo '<p>間隔: ' . $post_interval . '</p>';
echo '<p>次の注文日: ' . $post_next_order_date . '</p>';
echo '<p>注文数: ' . $post_order_count . '</p>';

?>


<h1>定期購入確認画面</h1>
<div class="box">
  <div class="field">
    <label class="label">商品名</label>
    <div class="control">
      
    </div>
  </div>
 
  <div class="field">
    <label class="label">商品画像</label>
    <div class="control" image>
      <img src="image/',$product_img,'" >
    </div>
  </div>
 
  <button class="button is-primary">サインイン</button>
</div>

<form action="G1-8-4.php" method="post">
    

</form>


